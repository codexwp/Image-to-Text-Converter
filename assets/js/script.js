
    var w=0,h=0;
    var a4w=595, a4h= 842;
    $(document).ready(function(){
        $("#btn-upload").click(function(){
            $("#file-input").click();
        })

        $("#file-input").change(function(){
            prepareimage(this);
        })

        function prepareimage(input){
            if (input.files && input.files[0]) {
                $("#orginal-image").show();
                $("#classified-image").hide();
                var reader = new FileReader();
                reader.onload = function (e) {
                    $img = $("#orginal-image").find("img");
                    $img.attr('src',e.target.result);
                    var base64 = e.target.result;
                    var arr = base64.split("base64,");
                    var base64 = arr[1];
                    $img.on('load',function(){
                        w = $img.prop('naturalWidth');
                        h = $img.prop('naturalHeight');
                    })

                    convertimagetotext(base64);

                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        function convertimagetotext(base64){
            var url = "vission-image-to-text.php";
            $.ajax({
                url: url,
                type: 'POST',
                data: {base64 : base64},
                dataType: 'json',
                beforeSend: function() {
                	$("#canvas").html("");
                	$("#canvas").show();
                	$("#output-box").html("");
                	$("#classified-image-canvas").html("");
                    $("#no-image").hide();
                    $("#output-box").hide();
                    $("#loading").show();
                },
                success: function (resp) {

                    if(resp.status=='fail') {
                        $("#no-image").show();
                        alert(resp.message);
                    }

                    if(resp.status=='success')
                    {
                        processingocr(resp.data);
                        $("#output-box").show();
                        
                    }

                    $("#loading").hide();
                    
                },
                error: function (x,t,e) {
                    console.log(x);
                }
            });
        }


        function processingocr(resp)
        {
            var obj = resp.responses[0].textAnnotations;

            var lang = obj[0].locale;
            var ft = obj[0].description;
            var t='',v = '',span = '',x=0,y=0;
            $("#output-box").css({"height":a4h+"px"});

            
            var svg = '<svg height="'+h+'" width="'+w+'" >';

            for(i=1;i<obj.length;i++)
            {
                /*For Output Box Text Recognition*/
                t = obj[i].description;
                v = obj[i].boundingPoly.vertices;
                x = parseInt(v[0].x);
                y = parseInt(v[0].y);
                if(w>a4w){x = (x/w) * a4w;}
                if(h>a4h){y = (y/h) * a4h;}
                span = '<span style="top:'+y+'px;left:'+x+'px">'+t+'</span>';
                $("#output-box").append($(span));

                /*For Creating Polygon in uploaded image*/
                svg = svg + '<polygon points="'+v[0].x+','+v[0].y+','+v[1].x+','+v[1].y+','+v[2].x+','+v[2].y+','+v[3].x+','+v[3].y+'" style="fill:transparent;stroke:purple;stroke-width:1" />';
            }
            svg = svg + '</svg>';
            $element = $("#canvas");
            $element.html($(svg));
            $("#classified-image").show();

            html2canvas($element, {
                onrendered: function (canvas) {
                    $("#classified-image-canvas").html(canvas);
                    $element.hide();
                }
            });

        }
    })