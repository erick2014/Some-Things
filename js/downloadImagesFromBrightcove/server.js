var fs = require('fs'),
    request = require('request'),
    LineByLineReader = require('line-by-line'),
    lr = new LineByLineReader('videos.txt'),
    errors=[];
//download the image
var download = function(uri, filename){
  request.head(uri, function(err, res, body){
    if(res!=undefined){
      if(res.statusCode==200){
        console.log(filename+" descargado :)");
        request(uri).pipe(fs.createWriteStream(filename));
      }
      else{
        error.push(filename);
      }
    }
  });
};

lr.on('error', function (err) {
    console.log("hubo un error");
});

lr.on('line', function (line) {
  var lineJson=JSON.parse(line);
  download(lineJson.videoStillURL,lineJson.id+".jpg");
});

lr.on('end', function () {
    // All lines are read, file is closed now.
    console.log("termino de leer el archivo")
});

