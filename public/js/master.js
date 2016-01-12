
$(function() {
        dojo.require('esri.layers.FeatureLayer');
        var objectid = parseInt($('#objectid').val());
        var nama_taman = $('#nama_taman');
        var kelompok_taman = $('#kelompok_taman');
        var kelurahan = $('#kelurahan');
        var luas_m2 = $('#luas_m2');
        var koordinat_x = $('#koordinat_x');
        var koordinat_y = $('#koordinat_y');
        var jenis_taman = $('#jenis_taman');
        var image_link = $('#image_link');
        var url_feature = $('#url_feature');
        var localEnum = (function(){
            var values = {
                RECORDS_PER_PAGE:15,
                HTTP_REQUEST_TIMEOUT:30000,
                PREVENT_OBJECTID_EDIT:true,
                TYPE:"type" /* featureService field type property */,
                OUTFIELDS:"*" /* outField property for FeatureLayer and Query */
            }

            return values;
        });
        var access = Boolean($('#access').val());

        
        if (access) {
            nama_taman.val('dd');
        };
        
      
        var featureLayer = new esri.layers.FeatureLayer('http://localhost:6080/arcgis/rest/services/RTH/Peta_RTH_Kota_Bogor_edit/FeatureServer/0', {
            outFields:[localEnum().OUTFIELDS]
        });
        var _spatialReference = featureLayer.spatialReference;

        var _add = function(data){
            console.log(data);
            try{
                var xVal = data.koordinat_x;
                var yVal = data.koordinat_y;
                
                if(isNaN(xVal) == true || isNaN(yVal) == true){
                    alert("Unable to update, location values aren't valid numbers");
                    return;
                }
                console.log(xVal + ' ' +yVal);
                var sms = new esri.symbol.SimpleMarkerSymbol().setStyle(
                     esri.symbol.SimpleMarkerSymbol.STYLE_SQUARE).setColor(
                     new dojo.Color([255,0,0,0.5]));
                var pt = new esri.geometry.Point(xVal,yVal,_spatialReference);
                var graphic = new esri.Graphic(pt,sms,data);

                insertNewFeature([graphic],null,true);

            }catch(err){
              console.log(err);
            }
        }
        
        var clear = function() {
            nama_taman.val('');
            kelompok_taman.val('');
            kelurahan.val('');
            luas_m2.val('');
            koordinat_x.val('');
            koordinat_y.val('');
            jenis_taman.val('');
            image_link.val('');

        }

        var insertNewFeature = function(/* Array */ graphic, /* String */ token, /* boolean */ confirm){
            featureLayer.applyEdits(graphic,null,null, function(response){
                    //var t = JSON.parse(response);
                    console.log(response);
                    if(response[0].success == true){


                        if(confirm)alert("Feature #" + response[0].objectId + " was successfully added." );
                    }
                    else{
                        console.log("insertNewFeature: There was a problem with writing the record to database");
                        
                        alert("There was a problem and feature was not added.");
                    }
            },function(error){
                    //NOTE: There is a bug in which the correct error message is not displayed
                    //Until it's fixed view the response payload in the Network tab of the developer tools.
                    var message = "";
                    console.log(error);
                    if(error.code)message = error.code;
                    if(error.description)message += error.description;
                    console.log("insertNewFeature: " + error.message + ", " + message);
                    alert("There was a problem adding a new feature: " + error.message + ", " + message);
            });
        }

        

        var loaddata = function (argument) {
            
        }
        $('.btn-simpan').click(function() {
          
            //_add(data);
            $.ajax({
                url: 'rth-getvalue',
                type: "get",
                dataType:'json',
                data: {'objectId':parseInt(objectid),
                      'nama_taman':nama_taman.val(),
                        'kelompok_taman' : kelompok_taman.val(),
                        'kelurahan' :kelurahan.val(),
                        'luas_m2': luas_m2.val(),
                        'koordinat_x': koordinat_x.val(),
                        'koordinat_y': koordinat_y.val(),
                        'jenis_taman': jenis_taman.val(),
                        'image_link': image_link.val(),
                      '_token': $('input[name=_token]').val()
                },
                success(data){
                    //console.log(data);
                    var newdata = [];
                    newdata.push({ 'data' : data });
               
                    _add(data);
                    
                    
                   // window.location.href = 'http://'+window.location.hostname+'/rth/public/layer';
                },

            })
        });
      $('.btn-clear').click(clear());
      
});









