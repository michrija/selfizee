<!-- Learn about this code on MDN: https://developer.mozilla.org/fr/docs/Tutoriel_canvas/Utilisation_d'images -->
<link href='style.css' rel='stylesheet'>
<html>
 <body onload="draw();">
 <ul>
                      
                      <li>
                        <input type="submit" name="enreg" value="Enregistrer" /> <input type="submit" name="enreg" value="Exporter" />
                      </li>
                      
                      </ul>                
                              
 <br/>
   <label>Importer votre photo</label>
   <input type="file" name="avatar" accept="image/*" required /><br/><br/>
   
   <div style="display:none;">
     <img id="source" src="file:///C:/Users/Bboy Churistan/Desktop/Churistan.jpg" width="300" height="227">
     <img id="frame" src="file:///C:/Users/Bboy Churistan/Desktop/Canvas_picture_frame.png" width="2084" height="1024">
   </div>
   
   <div id="wrapper">
                <div id="bander"></div>
                <div id="div1"></div>
                <div id="div2">
                <canvas id="canvas" width="150" height="150"></canvas><br/>
                </div>
                <div id="div3">div3</div>
                <div id="div4">Selfizee</align></div>
                
        </div>
   
        <script>
        
function draw() {
  var canvas = document.getElementById('canvas');
  var ctx = canvas.getContext('2d');

  // Draw slice
  ctx.drawImage(document.getElementById('source'),
                33, 71, 104, 124, 21, 20, 87, 104);

  // Draw frame
  ctx.drawImage(document.getElementById('frame'), 0, 0);
}
        
        </script>
   
 </body>
</html>