var coloresAleatorios = ["white", "yellow", "pink", "red", "lime", "blue"];

function colorAleatorio()	{
	return coloresAleatorios[Math.floor(Math.random() * 6)];
}

function colorAleatorio2()	{
	return coloresAleatorios[Math.floor(Math.random() * 3)];
}

function activar(tag, ini, fin)	{
	if (parseInt(fin) == 0)	{
		document.getElementById(tag).className = "";
		document.getElementById(tag).style.backgroundColor = "transparent";
		return;
	}
	if (ini == 0)	{
		document.getElementById(tag).style.backgroundColor = colorAleatorio();
		var actuar = "activar('" + tag + "', 0 , 0)";
		setTimeout(actuar, fin);
	}
	if (document.getElementById(tag).className == "_activa") return;
	document.getElementById(tag).className = "_activa";
	var actuar = "activar('" + tag + "', 0, " + fin + ")";
	setTimeout(actuar, ini);
}

function activar2(tag, ini, fin)	{
	if (parseInt(fin) == 0)	{
		document.getElementById(tag).className = "";
		document.getElementById(tag).style.backgroundColor = "transparent";
		return;
	}
	if (ini == 0)	{
		document.getElementById(tag).style.backgroundColor = colorAleatorio2();
		var actuar = "activar2('" + tag + "', 0 , 0)";
		setTimeout(actuar, fin);
	}
	if (document.getElementById(tag).className == "_activa") return;
	document.getElementById(tag).className = "_activa";
	var actuar = "activar2('" + tag + "', 0, " + fin + ")";
	setTimeout(actuar, ini);
}

function activar3(tag, ini, fin, msg)	{
	if (parseInt(fin) == 0)	{
		document.getElementById(tag).className = "";
		insertarDato(tag, ".");
		document.getElementById(tag).style.color = "transparent";
		document.getElementById(tag).style.backgroundColor = "transparent";
		return;
	}
	if (ini == 0)	{
		document.getElementById(tag).style.color = colorAleatorio2();
		insertarDato(tag, msg);
		var actuar = "activar3('" + tag + "', 0 , 0, '" + msg + "')";
		setTimeout(actuar, fin);
	}
	if (document.getElementById(tag).className == "_activa") return;
	document.getElementById(tag).className = "_activa";
	var actuar = "activar3('" + tag + "', 0, " + fin + ", '" + msg + "')";
	setTimeout(actuar, ini);
}

var cursy = (document.all) ? "hand" : "pointer";

function generaPunto()	{
	var Punto = "<div ";
	Punto += "title='" + this.nombre + "' id='" + this.id + "' style='position: absolute";
	with (this)	{
		Punto += "; top: " + y;
		Punto += "; left: " + x;
		Punto += "; width: 1; height: 1";
		Punto += "; visibility: " + visible;
		Punto += "; background-color: " + color;
		Punto += (click == "") ? "" : "; cursor: " + cursy + "' onclick='" + click;
		Punto += (over == "") ? "" : "' onmouseover='" + over;
		Punto += (out == "") ? "" : "' onmouseout='" + out;
		Punto += "'><span></span></div>";
	}
	return Punto;
}

function Punto(nombre, x, y, color, visible)	{
	this.nombre = nombre;
	this.info = "Punto";
	this.x = x;
	this.y = y;
	this.color = color;
	this.visible = visible;
	this.generar = generaPunto;
	this.click = "";
	this.over = "";
	this.out = "";
	this.id = "id" + Math.random();
}

function generaCuadrado()	{
	var Cuadro = "<div title='" + this.nombre + "' id='" + this.id + "' style='position: absolute";
	with (this)	{
		Cuadro += "; top: " + y;
		Cuadro += "; left: " + x;
		Cuadro += "; visibility: " + visible;
		Cuadro += "; width: " + ancho;
		Cuadro += "; height: " + alto;
		Cuadro += "; background-color: " + color;
		Cuadro += (click == "") ? "" : "; cursor: " + cursy + "' onclick='" + click;
		Cuadro += (over == "") ? "" : "' onmouseover='" + over;
		Cuadro += (out == "") ? "" : "' onmouseout='" + out;
	}
	Cuadro += "' ><span></span></div>";
	return Cuadro;
}

function Cuadrado(nombre, x, y, ancho, alto, color, visible)	{
	this.nombre = nombre;
	this.info = "Cuadrado";
	this.x = x;
	this.y = y;
	this.ancho = ancho;
	this.alto = alto;
	this.color = color;
	this.visible = visible;
	this.generar = generaCuadrado;
	this.click = "";
	this.over = "";
	this.out = "";
	this.id = "id" + Math.random();
}

function generaLinea()	{
	// chequeos
	if (
		(typeof(this.x1) != "number") ||
		(typeof(this.y1) != "number") ||
		(typeof(this.x2) != "number") ||
		(typeof(this.y1) != "number") ||
		(typeof(this.grosor) != "number") ||
		(this.grosor <= 0)
	)
		{ alert("Chequee los valores numéricos"); return}

	var esPunto = (this.x1 == this.x2 && this.y1 == this.y2 && this.grosor == 1);
	var esCuadro = (this.x1 == this.x2 && this.y1 == this.y2 && this.grosor > 1);
	var esEjeX = (this.x1 != this.x2 && this.y1 == this.y2 && this.grosor > 0);
	var esEjeY = (this.x1 == this.x2 && this.y1 != this.y2 && this.grosor > 0);
	var esOblicua = (this.x1 != this.x2 && this.y1 != this.y2 && this.grosor > 0);

	// definición provisoria para chequeos...
	var tipoLineas = ["Punto", "Cuadrado", "Paralela al eje X", "Paralela al eje Y", "oblicua", "error"];

	var tipo = (esPunto) ? 0 : (esCuadro) ? 1 : (esEjeX) ? 2 : (esEjeY) ? 3 : (esOblicua) ? 4 : 5;
	var miObjeto, miLinea;
	switch (tipo)	{
		case 0:
			with	(this)
				miObjeto = new Punto(this.nombre, x1, y1, color, visible);
			miObjeto.click = this.click;
			miObjeto.over = this.over;
			miObjeto.out = this.out;
			this.largo = 0;
			miLinea = miObjeto.generar();
			break;
		case 1:
			with	(this)
				miObjeto = new Cuadrado(this.nombre, x1, y1, grosor, grosor, color, visible);
			this.id = miObjeto.id;
			miObjeto.click = this.click;
			miObjeto.over = this.over;
			miObjeto.out = this.out;
			this.largo = 0;
			miLinea = miObjeto.generar();
			break;
		case 2:
			with (this)	{
				var iniX = (x1 < x2) ? x1 : x2;
				var ancho = (x1 < x2) ? (x2 - x1) : (x1 - x2);
				miObjeto = new Cuadrado(this.nombre, iniX, y1, ancho, grosor, color, visible);
			}
			this.id = miObjeto.id;
			miObjeto.click = this.click;
			miObjeto.over = this.over;
			miObjeto.out = this.out;
			this.largo = 0;
			miLinea = miObjeto.generar();
			break;
		case 3:
			with (this)	{
				var iniY = (y1 < y2) ? y1 : y2;
				var alto = (y1 < y2) ? (y2 - y1) : (y1 - y2);
				miObjeto = new Cuadrado(this.nombre, x1, iniY, grosor, alto, color, visible);
			}
			this.id = miObjeto.id;
			miObjeto.click = this.click;
			miObjeto.over = this.over;
			miObjeto.out = this.out;
			this.largo = 0;
			miLinea = miObjeto.generar();
			break;
		case 4:
			// oblicua
			with (this) var anchura = (x1 < x2) ? x2 - x1 : x1 - x2;
			with (this) var altura = (y1 < y2) ? y2 - y1 : y1 - y2;
			var esLarga = anchura > altura;
			var pendiente = (esLarga) ? anchura / altura : altura / anchura;
			with (this) var iniX = (x1 < x2) ? x1 : x2;
			with (this) var iniY = (y1 < y2) ? y1 : y2;
			miLinea = "<div style='position: absolute; background-color: transparent;"
			miLinea += " top: " + iniY;
			miLinea += "; left: " + iniX;
			miLinea += "; width: " + anchura;
			miLinea += "; height: " + altura;
//			miLinea += "; overflow: hidden";
			miLinea += "; visibility: " + this.visible;
			miLinea += "'>\n";

			// aquí va la linea

			// ponemos el primer punto...

			with (this) var iniX = (x1 < x2) ? 0 : anchura;
			with (this) var iniY = (y1 < y2) ? 0 : altura;

			with (this)	var esInversa = (x1 < x2) && (y2 < y1) || (x2 < x1) && (y1 < y2);
			this.largo = (esLarga) ? anchura : altura ;
			this.puntos = new Array(this.largo)
			var finBucle = this.largo - 1;

			with (this)	miObjeto = (grosor == 1) ? 
				new Punto(this.nombre, iniX, iniY, color, "visible") :
				new Cuadrado(this.nombre, iniX, iniY, grosor, grosor, color, "visible");
			miObjeto.click = this.click;
			miObjeto.over = this.over;
			miObjeto.out = this.out;

			this.puntos[0] = miObjeto.id;

			miLinea += miObjeto.generar();
			for (var i = 1; i < finBucle; i ++)	{
				iniX = (esLarga) ?
					i : 
					(esInversa) ? (anchura - parseInt(i * anchura / altura)) : 
					(parseInt(i * anchura / altura));
				iniY = (!esLarga) ?
					i :
					(esInversa) ? (altura - parseInt(i * altura / anchura)) :
					(parseInt(i * altura / anchura));
				with (this)	miObjeto = (grosor == 1) ? 
					new Punto(this.nombre, iniX, iniY, color, "visible") :
					new Cuadrado(this.nombre, iniX, iniY, grosor, grosor, color, "visible");
				miObjeto.click = this.click;
				miObjeto.over = this.over;
				miObjeto.out = this.out;

				this.puntos[i] = miObjeto.id;

				miLinea += miObjeto.generar();
			}
			miLinea += "</div>";
			break;			
	}
	return miLinea;
}

function generaLinea2()	{
	// chequeos
	if (
		(typeof(this.x1) != "number") ||
		(typeof(this.y1) != "number") ||
		(typeof(this.x2) != "number") ||
		(typeof(this.y1) != "number") ||
		(typeof(this.grosor) != "number") ||
		(this.grosor <= 0)
	)
		{ alert("Chequee los valores numéricos"); return}

	var esPunto = (this.x1 == this.x2 && this.y1 == this.y2 && this.grosor == 1);
	var esCuadro = (this.x1 == this.x2 && this.y1 == this.y2 && this.grosor > 1);
	var esEjeX = (this.x1 != this.x2 && this.y1 == this.y2 && this.grosor > 0);
	var esEjeY = (this.x1 == this.x2 && this.y1 != this.y2 && this.grosor > 0);
	var esOblicua = (this.x1 != this.x2 && this.y1 != this.y2 && this.grosor > 0);

	// definición provisoria para chequeos...
	var tipoLineas = ["Punto", "Cuadrado", "Paralela al eje X", "Paralela al eje Y", "oblicua", "error"];

	var tipo = (esPunto) ? 0 : (esCuadro) ? 1 : (esEjeX) ? 2 : (esEjeY) ? 3 : (esOblicua) ? 4 : 5;
	var miObjeto, miLinea, iniX, iniY, ancho, alto, anchura, altura,
		esLarga, esInversa, iniBucle, finBucle, pendiente;
	switch (tipo)	{
		case 0:
			with	(this)
				miObjeto = new Punto(this.nombre, x1, y1, color, visible);
			miObjeto.click = this.click;
			miObjeto.over = this.over;
			miObjeto.out = this.out;
			this.largo = 0;
			miLinea = miObjeto.generar();
			break;
		case 1:
			with	(this)
				miObjeto = new Cuadrado(this.nombre, x1, y1, grosor, grosor, color, visible);
			this.id = miObjeto.id;
			miObjeto.click = this.click;
			miObjeto.over = this.over;
			miObjeto.out = this.out;
			this.largo = 0;
			miLinea = miObjeto.generar();
			break;
		case 2:
			with (this)	{
				iniX = (x1 < x2) ? x1 : x2;
				ancho = (x1 < x2) ? (x2 - x1) : (x1 - x2);
				miObjeto = new Cuadrado(this.nombre, iniX, y1, ancho, grosor, color, visible);
			}
			this.id = miObjeto.id;
			miObjeto.click = this.click;
			miObjeto.over = this.over;
			miObjeto.out = this.out;
			this.largo = 0;
			miLinea = miObjeto.generar();
			break;
		case 3:
			with (this)	{
				iniY = (y1 < y2) ? y1 : y2;
				alto = (y1 < y2) ? (y2 - y1) : (y1 - y2);
				miObjeto = new Cuadrado(this.nombre, x1, iniY, grosor, alto, color, visible);
			}
			this.id = miObjeto.id;
			miObjeto.click = this.click;
			miObjeto.over = this.over;
			miObjeto.out = this.out;
			this.largo = 0;
			miLinea = miObjeto.generar();
			break;
		case 4:
			// oblicua
			with (this) anchura = (x1 < x2) ? x2 - x1 : x1 - x2;
			with (this) altura = (y1 < y2) ? y2 - y1 : y1 - y2;
			esLarga = anchura > altura;
			pendiente = (esLarga) ? anchura / altura : altura / anchura;
			with (this) iniX = (x1 < x2) ? x1 : x2;
			with (this) iniY = (y1 < y2) ? y1 : y2;
			miLinea = "<div style='position: absolute; background-color: transparent;"
			miLinea += " top: " + iniY;
			miLinea += "; left: " + iniX;
			miLinea += "; width: " + anchura;
			miLinea += "; height: " + altura;
//			miLinea += "; overflow: hidden";
			miLinea += "; visibility: " + this.visible;
			miLinea += "'>\n";

			// aquí va la linea

			// ponemos el primer punto...

			with (this) iniX = x1;
			with (this) iniY = y1;

			with (this)	esInversa = (x1 < x2) && esLarga || (y1 < y2) && (!esLarga);
			this.largo = (esLarga) ? anchura : altura;
			this.puntos = new Array(this.largo + 1);
			incremento = (esInversa) ? -1 : 1;
			iniBucle = 0;//(EsLarga) ? x1 : y1;
			finBucle = (EsLarga) ? x2 : y2;
/*
			var finBucle = this.largo - 1;
			with (this)	miObjeto = (grosor == 1) ? 
				new Punto(this.nombre, iniX, iniY, color, "visible") :
				new Cuadrado(this.nombre, iniX, iniY, grosor, grosor, color, "visible");
			miObjeto.click = this.click;
			miObjeto.over = this.over;
			miObjeto.out = this.out;
			this.puntos[0] = miObjeto.id;
			miLinea += miObjeto.generar();
*/

			for (var i = iniBucle; i != finBucle; i = i + incremento)	{
				iniX = (esLarga) ?
					i : 
					(esInversa) ? (anchura - parseInt(i * anchura / altura)) : 
					(parseInt(i * anchura / altura));
				iniY = (!esLarga) ?
					i :
					(esInversa) ? (altura - parseInt(i * altura / anchura)) :
					(parseInt(i * altura / anchura));
				with (this)	miObjeto = (grosor == 1) ? 
					new Punto(this.nombre, iniX, iniY, color, "visible") :
					new Cuadrado(this.nombre, iniX, iniY, grosor, grosor, color, "visible");
				miObjeto.click = this.click;
				miObjeto.over = this.over;
				miObjeto.out = this.out;

				this.puntos[i] = miObjeto.id;

				miLinea += miObjeto.generar();
			}
			miLinea += "</div>";
			break;			
	}
	return miLinea;
}




function Linea(nombre, x1, y1, x2, y2, grosor, color, visible)	{
	this.nombre = nombre;
	this.info = "Linea";
	this.x1 = x1;
	this.y1 = y1;
	this.x2 = x2;
	this.y2 = y2;
	this.grosor = grosor;
	this.color = color;
	this.visible = visible;
	this.generar = generaLinea;
	this.click = "";
	this.over = "";
	this.out = "";
	this.id = "id" + Math.random();
	this.largo = -1;
	this.puntos = "";
}

function generaCircunferencia1()	{
	if (
		(typeof(this.x) != "number") ||
		(typeof(this.y) != "number") ||
		(typeof(this.radio) != "number")
	)
		{ alert("Chequee los valores numéricos"); return}
	var esPunto = (this.radio == 1);
	var tipo = (esPunto) ? 0 : 1;
	var miObjeto, miCircunferencia;
	switch (tipo)	{
		case 0:
			with	(this)
				miObjeto = new Punto(nombre, x, y, color, visible);
			
			miObjeto.click = this.click;
			miObjeto.over = this.over;
			miObjeto.out = this.out;
			this.largo = 0;
			miCircunferencia = miObjeto.generar();
			break;
		case 1:
			with (this) var iniX = x - this.radio;
			with (this) var iniY = y - this.radio;
			miCircunferencia = "<div style='position: absolute; background-color: transparent;"
			miCircunferencia += " top: " + iniY;
			miCircunferencia += "; left: " + iniX;
			miCircunferencia += "; width: " + this.radio * 2;
			miCircunferencia += "; height: " + this.radio * 2;
			miCircunferencia += "; visibility: " + this.visible;
			miCircunferencia += "' id='" + this.id + "'>\n";

			// aquí van los puntos intermedios

			this.largo = this.radio + 1;
			this.puntos = new Array(4, this.largo);
			var finBucle = this.radio + 1;
			var Radio2 = this.radio * this.radio;
			var Diametro = this.radio * 2;

			for (var i = 0; i < finBucle; i ++)	{

				// lado inferior-derecho del globo
				iniX = this.radio + parseInt(Math.sqrt(Radio2 - (i * i)));
				iniY = this.radio + i;
				miObjeto = new Punto(this.nombre, iniX, iniY, this.color, "visible");
				miObjeto.click = this.click;
				miObjeto.over = this.over;
				miObjeto.out = this.out;
				this.puntos[0, i] = miObjeto.id;
				miCircunferencia += miObjeto.generar();

				// lado inferior-izquierdo del globo
				iniX = this.radio - parseInt(Math.sqrt(Radio2 - (i * i)));
				iniY = this.radio + i;
				miObjeto = new Punto(this.nombre, iniX, iniY, this.color, "visible");
				miObjeto.click = this.click;
				miObjeto.over = this.over;
				miObjeto.out = this.out;
				this.puntos[1, i] = miObjeto.id;
				miCircunferencia += miObjeto.generar();

				// lado superior-izquierdo del globo
				iniX = this.radio - parseInt(Math.sqrt(Radio2 - (i * i)));
				iniY = this.radio - i;
				miObjeto = new Punto(this.nombre, iniX, iniY, this.color, "visible");
				miObjeto.click = this.click;
				miObjeto.over = this.over;
				miObjeto.out = this.out;
				this.puntos[2, i] = miObjeto.id;
				miCircunferencia += miObjeto.generar();

				// lado superior-derecho del globo
				iniX = this.radio + parseInt(Math.sqrt(Radio2 - (i * i)));
				iniY = this.radio - i;
				miObjeto = new Punto(this.nombre, iniX, iniY, this.color, "visible");
				miObjeto.click = this.click;
				miObjeto.over = this.over;
				miObjeto.out = this.out;
				this.puntos[3, i] = miObjeto.id;
				miCircunferencia += miObjeto.generar();
			}
			miCircunferencia += "</div>";
			break
	}
	return miCircunferencia;
}

function generaCircunferencia2()	{
	if (
		(typeof(this.x) != "number") ||
		(typeof(this.y) != "number") ||
		(typeof(this.radio) != "number")
	)
		{ alert("Chequee los valores numéricos"); return}
	var esPunto = (this.radio == 1);
	var tipo = (esPunto) ? 0 : 1;
	var miObjeto, miCircunferencia;
	switch (tipo)	{
		case 0:
			with	(this)
				miObjeto = new Punto(nombre, x, y, color, visible);
			
			miObjeto.click = this.click;
			miObjeto.over = this.over;
			miObjeto.out = this.out;
			this.largo = 0;
			miCircunferencia = miObjeto.generar();
			break;
		case 1:
			with (this) var iniX = x - this.radio;
			with (this) var iniY = y - this.radio;
			miCircunferencia = "<div style='position: absolute; background-color: transparent;"
			miCircunferencia += " top: " + iniY;
			miCircunferencia += "; left: " + iniX;
			miCircunferencia += "; width: " + this.radio * 2;
			miCircunferencia += "; height: " + this.radio * 2;
			miCircunferencia += "; visibility: " + this.visible;
			miCircunferencia += "' id='" + this.id + "'>\n";

			// aquí van los puntos intermedios

			this.largo = this.radio + 1;
			this.puntos = new Array(4, this.largo);
			var finBucle = this.radio + 1;
			var Radio2 = this.radio * this.radio;
			var Diametro = this.radio * 2;

			for (var i = 0; i < finBucle; i ++)	{

				// lado inferior-derecho del globo
				iniY = this.radio + parseInt(Math.sqrt(Radio2 - (i * i)));
				iniX = this.radio + i;
				miObjeto = new Punto(this.nombre, iniX, iniY, this.color, "visible");
				miObjeto.click = this.click;
				miObjeto.over = this.over;
				miObjeto.out = this.out;
				this.puntos[0, i] = miObjeto.id;
				miCircunferencia += miObjeto.generar();

				// lado inferior-izquierdo del globo
				iniY = this.radio - parseInt(Math.sqrt(Radio2 - (i * i)));
				iniX = this.radio + i;
				miObjeto = new Punto(this.nombre, iniX, iniY, this.color, "visible");
				miObjeto.click = this.click;
				miObjeto.over = this.over;
				miObjeto.out = this.out;
				this.puntos[1, i] = miObjeto.id;
				miCircunferencia += miObjeto.generar();

				// lado superior-izquierdo del globo
				iniY = this.radio - parseInt(Math.sqrt(Radio2 - (i * i)));
				iniX = this.radio - i;
				miObjeto = new Punto(this.nombre, iniX, iniY, this.color, "visible");
				miObjeto.click = this.click;
				miObjeto.over = this.over;
				miObjeto.out = this.out;
				this.puntos[2, i] = miObjeto.id;
				miCircunferencia += miObjeto.generar();

				// lado superior-derecho del globo
				iniY = this.radio + parseInt(Math.sqrt(Radio2 - (i * i)));
				iniX = this.radio - i;
				miObjeto = new Punto(this.nombre, iniX, iniY, this.color, "visible");
				miObjeto.click = this.click;
				miObjeto.over = this.over;
				miObjeto.out = this.out;
				this.puntos[3, i] = miObjeto.id;
				miCircunferencia += miObjeto.generar();
			}
			miCircunferencia += "</div>";
			break
	}
	return miCircunferencia;
}

function Circunferencia1(nombre, x, y, radio, color, visible)	{
	this.nombre = nombre;
	this.info = "Circunferencia";
	this.x = x;
	this.y = y;
	this.radio = radio;
	this.color = color;
	this.visible = visible;
	this.generar = generaCircunferencia1;
	this.click = "";
	this.over = "";
	this.out = "";
	this.id = "id" + Math.random();
	this.largo = -1;
	this.puntos = "";
}

function Circunferencia2(nombre, x, y, radio, color, visible)	{
	this.nombre = nombre;
	this.info = "Circunferencia";
	this.x = x;
	this.y = y;
	this.radio = radio;
	this.color = color;
	this.visible = visible;
	this.generar = generaCircunferencia2;
	this.click = "";
	this.over = "";
	this.out = "";
	this.id = "id" + Math.random();
	this.largo = -1;
	this.puntos = "";
}

function generaEsfera()	{
	if (
		(typeof(this.x) != "number") ||
		(typeof(this.y) != "number") ||
		(typeof(this.radio) != "number")
	)
		{ alert("Chequee los valores numéricos"); return}
	var esPunto = (this.radio == 1);
	var tipo = (esPunto) ? 0 : 1;
	var miObjeto, miEsfera;
	switch (tipo)	{
		case 0:
			with	(this)
				miObjeto = new Punto(nombre, x, y, color, visible);
			
			miObjeto.click = this.click;
			miObjeto.over = this.over;
			miObjeto.out = this.out;
			this.largo = 0;
			miEsfera = miObjeto.generar();
			break;
		case 1:
			with (this) var iniX = x - this.radio;
			with (this) var iniY = y - this.radio;
			miEsfera = "<div style='position: absolute; background-color: transparent;"
			miEsfera += " top: " + iniY;
			miEsfera += "; left: " + iniX;
			miEsfera += "; width: " + this.radio * 2;
			miEsfera += "; height: " + this.radio * 2;
//			miEsfera += "; overflow: hidden";
			miEsfera += "; visibility: " + this.visible;
			miEsfera += "' id='" + this.id + "'>\n";

			// aquí van los puntos intermedios

			this.largo = this.radio + 1;
			this.lineas = new Array(2, this.largo);
			var finBucle = this.radio + 1;
			var Radio2 = this.radio * this.radio;
			var Diametro = this.radio * 2;

			for (var i = 0; i < finBucle; i ++)	{

				// lado inferior del globo
				iniX1 = this.radio - parseInt(Math.sqrt(Radio2 - i * i));
				iniX2 = this.radio + parseInt(Math.sqrt(Radio2 - i * i));
				iniY = this.radio - i;
				miObjeto = new Linea(this.nombre, iniX1, iniY, iniX2, iniY, 1, this.color, "visible");
				miObjeto.click = this.click;
				miObjeto.over = this.over;
				miObjeto.out = this.out;
				this.puntos[0, i] = miObjeto.id;
				miEsfera += miObjeto.generar();


				// lado superior-derecho del globo
				iniX1 = this.radio - parseInt(Math.sqrt(Radio2 - i * i));
				iniX2 = this.radio + parseInt(Math.sqrt(Radio2 - i * i));
				iniY = this.radio + i;
				miObjeto = new Linea(this.nombre, iniX1, iniY, iniX2, iniY, 1, this.color, "visible");
				miObjeto.click = this.click;
				miObjeto.over = this.over;
				miObjeto.out = this.out;
				this.puntos[1, i] = miObjeto.id;
				miEsfera += miObjeto.generar();

			}
			miEsfera += "</div>";
			break
	}
	return miEsfera;
}

function Esfera(nombre, x, y, radio, color, visible)	{
	this.nombre = nombre;
	this.info = "Circunferencia";
	this.x = x;
	this.y = y;
	this.radio = radio;
	this.color = color;
	this.visible = visible;
	this.generar = generaEsfera;
	this.click = "";
	this.over = "";
	this.out = "";
	this.id = "id" + Math.random();
	this.largo = -1;
	this.puntos = "";
}

function insertarDato(tag, Dato)	{// hay que insertar dentro del tag span ¿?
	document.getElementById(tag).getElementsByTagName("span")[0].innerHTML = Dato;
}

function agregarDato(tag, Dato)	{// hay que agregar dentro del tag span ¿?
	document.getElementById(tag).getElementsByTagName("span")[0].innerHTML += Dato;
}


function generaCircunferencia()	{
	if (
		(typeof(this.x) != "number") ||
		(typeof(this.y) != "number") ||
		(typeof(this.radio) != "number")
	)
		{ alert("Chequee los valores numéricos"); return}
	var esPunto = (this.radio == 1);
	var tipo = (esPunto) ? 0 : 1;
	var miObjeto, miCircunferencia;
	switch (tipo)	{
		case 0:
			with	(this)
				miObjeto = new Punto(nombre, x, y, color, visible);
			
			miObjeto.click = this.click;
			miObjeto.over = this.over;
			miObjeto.out = this.out;
			this.largo = 0;
			miCircunferencia = miObjeto.generar();
			break;
		case 1:
			with (this) var iniX = x - this.radio;
			with (this) var iniY = y - this.radio;
			miCircunferencia = "<div style='position: absolute; background-color: transparent;"
			miCircunferencia += " top: " + iniY;
			miCircunferencia += "; left: " + iniX;
			miCircunferencia += "; width: " + this.radio * 2;
			miCircunferencia += "; height: " + this.radio * 2;
			miCircunferencia += "; visibility: " + this.visible;
			miCircunferencia += "' id='" + this.id + "'>\n";

			// aquí van los puntos intermedios


			this.largo = this.radio + 1;
			this.puntos = new Array(8, this.largo);

//			var finBucle = parseInt(this.radio * 3 / 4);
			var finBucle = this.radio + 1;

//			this.largo = finBucle;
//			this.puntos = new Array(8, finBucle);


			var Radio2 = this.radio * this.radio;
			var Diametro = this.radio * 2;
			var mitadBucle = parseInt(finBucle / 2);
			for (var i = 0; i < finBucle; i ++)	{

				// lado inferior-derecho del globo
				iniX = this.radio + parseInt(Math.sqrt(Radio2 - (i * i)));
				iniY = this.radio + i;
				miObjeto = new Punto(this.nombre, iniX, iniY, this.color, "visible");
				miObjeto.click = this.click;
				miObjeto.over = this.over;
				miObjeto.out = this.out;
				this.puntos[0, i] = miObjeto.id;
				miCircunferencia += miObjeto.generar();

				// lado inferior-izquierdo del globo
				iniX = this.radio - parseInt(Math.sqrt(Radio2 - (i * i)));
				iniY = this.radio + i;
				miObjeto = new Punto(this.nombre, iniX, iniY, this.color, "visible");
				miObjeto.click = this.click;
				miObjeto.over = this.over;
				miObjeto.out = this.out;
				this.puntos[1, i] = miObjeto.id;
				miCircunferencia += miObjeto.generar();

				// lado superior-izquierdo del globo
				iniX = this.radio - parseInt(Math.sqrt(Radio2 - (i * i)));
				iniY = this.radio - i;
				miObjeto = new Punto(this.nombre, iniX, iniY, this.color, "visible");
				miObjeto.click = this.click;
				miObjeto.over = this.over;
				miObjeto.out = this.out;
				this.puntos[2, i] = miObjeto.id;
				miCircunferencia += miObjeto.generar();

				// lado superior-derecho del globo
				iniX = this.radio + parseInt(Math.sqrt(Radio2 - (i * i)));
				iniY = this.radio - i;
				miObjeto = new Punto(this.nombre, iniX, iniY, this.color, "visible");
				miObjeto.click = this.click;
				miObjeto.over = this.over;
				miObjeto.out = this.out;
				this.puntos[3, i] = miObjeto.id;
				miCircunferencia += miObjeto.generar();




				// lado inferior-derecho del globo
				iniY = this.radio + parseInt(Math.sqrt(Radio2 - (i * i)));
				iniX = this.radio + i;
				miObjeto = new Punto(this.nombre, iniX, iniY, this.color, "visible");
				miObjeto.click = this.click;
				miObjeto.over = this.over;
				miObjeto.out = this.out;
				this.puntos[4, i] = miObjeto.id;
				miCircunferencia += miObjeto.generar();

				// lado inferior-izquierdo del globo
				iniY = this.radio - parseInt(Math.sqrt(Radio2 - (i * i)));
				iniX = this.radio + i;
				miObjeto = new Punto(this.nombre, iniX, iniY, this.color, "visible");
				miObjeto.click = this.click;
				miObjeto.over = this.over;
				miObjeto.out = this.out;
				this.puntos[5, i] = miObjeto.id;
				miCircunferencia += miObjeto.generar();

				// lado superior-izquierdo del globo
				iniY = this.radio - parseInt(Math.sqrt(Radio2 - (i * i)));
				iniX = this.radio - i;
				miObjeto = new Punto(this.nombre, iniX, iniY, this.color, "visible");
				miObjeto.click = this.click;
				miObjeto.over = this.over;
				miObjeto.out = this.out;
				this.puntos[6, i] = miObjeto.id;
				miCircunferencia += miObjeto.generar();

				// lado superior-derecho del globo
				iniY = this.radio + parseInt(Math.sqrt(Radio2 - (i * i)));
				iniX = this.radio - i;
				miObjeto = new Punto(this.nombre, iniX, iniY, this.color, "visible");
				miObjeto.click = this.click;
				miObjeto.over = this.over;
				miObjeto.out = this.out;
				this.puntos[7, i] = miObjeto.id;
				miCircunferencia += miObjeto.generar();





			}
			miCircunferencia += "</div>";
			break
	}
	return miCircunferencia;
}

function Circunferencia(nombre, x, y, radio, color, visible)	{
	this.nombre = nombre;
	this.info = "Circunferencia";
	this.x = x;
	this.y = y;
	this.radio = radio;
	this.color = color;
	this.visible = visible;
	this.generar = generaCircunferencia;
	this.click = "";
	this.over = "";
	this.out = "";
	this.id = "id" + Math.random();
	this.largo = -1;
	this.puntos = "";
}

