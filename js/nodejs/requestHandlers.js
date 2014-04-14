//in this module have the request controller

//this module is to list all files in the current directory
var exec=require("child_process").exec;
//this module is to manipulate string of a request(start?foo=bar&hello=world)
var querystring=require("querystring");

function start(response,dataPosted){
    console.log("Handler initializer was called...");
    
    var page='<html>'+
                '<head>'+
                    '<meta http-equip="Content-Type" content="text/html;charset=UTF-8" >'+
                '</head>'+
                '<body>'+
                    '<form action="/upload" method="post">'+
                        '<textarea name="myInfo" rows="20" cols="60"></textarea>'+
                        '<input type="submit" value="Submit text"/>'+
                     '</form>'+
                '</body>'
             '</html>';
    response.writeHead(200,{"Content-Type":"text/html"});
    response.write(page);
    response.end();
}

function upload(response,dataPosted){
    console.log("handler to upload handler, was called..");
    response.writeHead( 200,{"Content-Type":"text/html"} );
    //here we use the querystring object to get the post data from the field with name text
    response.write("And your text was= "+querystring.parse(dataPosted)["text"]);
    response.end();
}

exports.start=start;
exports.upload=upload;