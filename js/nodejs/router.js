function route(handle,pathname,response,dataPosted){
    
    console.log(" About to route a request for "+pathname);
    //if the object handle has that pathname received, then we keep going
    if( typeof handle[pathname]==='function' ){
        //we call the handler function, and we pass the response object, and the post data that has been captured
        return handle[pathname](response,dataPosted);
    }else{
        console.log("No request handler found for "+pathname);
        response.writeHead( 404,{"Content-Type":"text/html"} );
        response.write("404 Not found");
        response.end();
        return "404 No Encontrado";
    }
}
exports.route=route;