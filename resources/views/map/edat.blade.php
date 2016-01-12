<!DOCTYPE html>
<html> 
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <!--The viewport meta tag is used to improve the presentation and behavior of the samples 
      on iOS devices-->
    <meta name="viewport" content="initial-scale=1, maximum-scale=1,user-scalable=no">
    <title>SanFrancisco311 - Incidents</title>

    <link rel="stylesheet" href="http://js.arcgis.com/3.13/esri/css/esri.css">
    <style>
      html, body { height: 100%; width: 100%; margin: 0; overflow: hidden; }
      #map { height: 100%; padding: 0;}
      #footer { height: 2em; text-align: center; font-size: 1.1em; padding: 0.5em; }
      .dj_ie .infowindow .window .top .right .user .content { position: relative; }
      .dj_ie .simpleInfoWindow .content {position: relative;}
    </style>

    <script src="http://js.arcgis.com/3.13/"></script>
    <script>
      var map;
      
      require([
        "esri/map",
        "esri/layers/FeatureLayer",
        "esri/dijit/editing/AttachmentEditor",
        "esri/config",

        "dojo/parser", "dojo/dom",

        "dijit/layout/BorderContainer", "dijit/layout/ContentPane", "dojo/domReady!"
      ], function(
        Map, FeatureLayer, AttachmentEditor, esriConfig,
        parser, dom
      ) {
        parser.parse();
        // a proxy page is required to upload attachments
        // refer to "Using the Proxy Page" for more information:  https://developers.arcgis.com/javascript/jshelp/ags_proxy.html
        esriConfig.defaults.io.proxyUrl = "/proxy/";
      
        map = new Map("map", { 
          basemap: "streets",
          center: [-122.427, 37.769],
          zoom: 17
        });
        map.on("load", mapLoaded);

        function mapLoaded() {
          var featureLayer = new FeatureLayer("http://sampleserver3.arcgisonline.com/ArcGIS/rest/services/SanFrancisco/311Incidents/FeatureServer/0",{
            mode: FeatureLayer.MODE_ONDEMAND
          });

          map.infoWindow.setContent("<div id='content' style='width:100%'></div>");
          map.infoWindow.resize(350,200);
          var attachmentEditor = new AttachmentEditor({}, dom.byId("content"));
          attachmentEditor.startup();

          featureLayer.on("click", function(evt) {
            var objectId = evt.graphic.attributes[featureLayer.objectIdField];
            map.infoWindow.setTitle(objectId);
            attachmentEditor.showAttachments(evt.graphic,featureLayer);
            map.infoWindow.show(evt.screenPoint, map.getInfoWindowAnchor(evt.screenPoint));
          });
          map.addLayer(featureLayer);
        }
      });
    </script>
  </head>

  <body>
    <div data-dojo-type="dijit/layout/BorderContainer" 
         data-dojo-props="design:'headline'" 
         style="width:100%;height:100%;">

      <div id="map" 
           data-dojo-type="dijit/layout/ContentPane" 
           data-dojo-props="region:'center'"></div>

      <div id="footer"
           data-dojo-type="dijit/layout/ContentPane" 
           data-dojo-props="region:'bottom'">
        Click point to view/create/delete attachments.
      </div>
    </div>
  </body>
</html>