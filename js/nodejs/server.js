//we use this module to get all parts from a url(path)
var http=require( "http" );
//incluyo el modulo para parsear las url
var url=require( "url" );

//from My index file, I pass the route function and the handle object that has the allowed paths
function iniciar(route,handle){
    //funcion call back que recibe un objeto request y uno response
    function onRequest( request, response ){
        //data por post
        var dataPosted="";
        //obtengo el path al que va
        var pathname=url.parse(request.url).pathname;
        console.log("Request for "+pathname+" received.");
        //we hope the utf-8 codification
        request.setEncoding("utf-8");
        
        //this listener will concat all data packets
        request.addListener("data",function(dataSmallPacket){
            dataPosted+=dataSmallPacket;
            console.log("We have received a small post part.. '"+ dataSmallPacket +"'.");
        });
        //we execute this listener when we get all data post packets
        request.addListener("end",function(){
           route(handle,pathname,response,dataPosted); 
        });
        
        
        route(handle,pathname,response);
    }
    //creo mi servidor, le paso mi callback e indico que escuche en el puerto 8888
    http.createServer(onRequest).listen(8888);
    //indico que el servidor se inicio
    console.log( "Server is running..." );
}
//exporto mi funcion iniciar, para que pueda ser utilizada desde otro archivo
exports.iniciar=iniciar;
