//Objeto recuadro
//Objeto que permite recortar imagenes y trabajar con el fragmento recortado
//Sintaxis new Recuadro(x,y,ancho,alto,contenedor)
//x coordenada x del extremo superior del recuadro en pixels
//y coordenada y del extremo superior del recuadro en pixels
//ancho ancho en pixels
//alto alto en pixels

function Recuadro(x,y,ancho,alto,imagen){
    this.x=x;
    this.y=y;
    this.ancho=ancho;
    this.alto=alto;
    this.imagen=imagen;
    this.contenedor=null;
    this.dom=null;
    this.mouseX=0;
    this.mouseY=0;
}


Recuadro.prototype.pinta=function(color="black"){
    //Creo el div y configuro su estilo
    var rec=document.createElement("div");
    rec.style.position="absolute";
    rec.style.top=this.x+"px";
    rec.style.left=this.y+"px";
    rec.style.width=this.ancho+"px";
    rec.style.height=this.alto+"px";
    rec.style.border="1px solid " + color;
    rec.style.zIndex=99;
    //Programo el movimiento del cuadradito
    rec.addEventListener("mousedown",pulsadoRaton(this))
    rec.addEventListener("mousemove",moverRaton(this))
    rec.addEventListener("mouseup",soltarRaton(this))
    
    this.dom=rec;
    //Creo un contenedor para la imagen donde aÃ±adir el div creado encima;
    var contenedor=document.createElement("div");
    contenedor.style.position="relative";
    contenedor.style.display="inline-block"
    this.contenedor=contenedor;
    //Lo introduzco justo delante de la imagen, introduciendo la imagen dentro 
    //y el cuadradito.
    this.imagen.parentNode.insertBefore(contenedor,this.imagen);
    contenedor.appendChild(this.imagen);
    contenedor.appendChild(rec);

    function pulsadoRaton(objeto){
        return function(ev){
            //Si he pulsado el botÃ³n izquierdo muevo el cuadradito
            if(ev.buttons>0 && ev.button==0){
                 objeto.mouseX=ev.offsetX;
                 objeto.mouseY=ev.offsetY;
            }
        }
    }
    function moverRaton(objeto){
        return function(ev){
            //Si he pulsado el botÃ³n izquierdo muevo el cuadradito
            if(ev.buttons>0 && ev.button==0){
                 objeto.dom.style.left=parseInt(objeto.dom.style.left)+(ev.offsetX-objeto.mouseX)+"px";
                 objeto.dom.style.top=parseInt(objeto.dom.style.top)+(ev.offsetY-objeto.mouseY)+"px";
            }
        }
    }

    function soltarRaton(objeto){
        return function(ev){
            //Si he pulsado el botÃ³n izquierdo muevo el cuadradito
            //Borro el auxiliar del movimiento
            objeto.mouseX=0;
            objeto.mouseY=0;
            objeto.x=parseInt(objeto.dom.style.left);
            objeto.y=parseInt(objeto.dom.style.top);
        }
    }
}

Recuadro.prototype.recortar=function(){
    var c=document.createElement("canvas");
    var img=document.createElement("img");
    //defino el tamaÃ±o del canvas y la imagen
    c.width=this.ancho;
    c.height=this.alto;
    img.width=this.ancho;
    img.height=this.alto;
    var ctx=c.getContext("2d");
    ctx.drawImage(this.imagen,this.x,this.y,this.ancho,this.alto,0,0,this.ancho,this.alto);
    img.src=c.toDataURL();
    return c;
}