<!DOCTYPE html>
<html>

<head>
    <meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
    <title>Buzzo - SEO</title>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="stylesheet" href="css/seo.css">
    <link href='css/estinicio.css?v=5.76' rel='stylesheet' type='text/css'>
    <link href='css/jquery-ui.min.css' rel='stylesheet' type='text/css'>
    <link rel='icon' type='image/png' href='imagen/fav16x16.png' sizes='16x16' />
    <link rel='icon' type='image/png' href='imagen/fav32x32.png' sizes='32x32' />
    <link rel='apple-touch-icon-precomposed' sizes='72x72' href='imagen/72x72.png' />
    <link rel='apple-touch-icon-precomposed' sizes='57x57' href='imagen/fav57x57.png' />
    <link rel='apple-touch-icon-precomposed' sizes='144x144' href='imagen/fav144x144.png' />
    <link rel='apple-touch-icon-precomposed' sizes='192x192' href='imagen/fav192x192.png' />
    <script type='text/javascript'>
        generaz = '100d662be0770413bd4f18ecc7e1c76d';
    </script>
    <script src='scripts/jquery-3.6.4.min.js' type='text/javascript'></script>
    <script src='scripts/jquery-ui.min.js' type='text/javascript'></script>
    <script src='scripts/iniciob.js' type='text/javascript'></script>
</head>

<body onLoad='if (self != top) top.location = self.location'>
    <div id='fondo'></div>
    <div id='fconte_1' class='fondoconte'>
        <div class='contenidos'>
            <div class='cabecera'>
                <img src='imagen/buzzo.svg' />
                <br />
                <span>Técnico Cubetic Consultores</span>
            </div>
            <div class='titulo'>Proyectos</div>
            <div class="empresas">
                <ul>
                    <li onclick="empresa()">
                        <span class="empresafoto"><img src="imagen/empresa.jpg" border="0"></span>
                        <span class="empresaconte">
                            <span class="empresacontea">Empresa de Prueba</span>
                            <span class="empresaconteb">C/Balmes 210</span>
                            <span class="empresacontec">8006 BARCELONA (BARCELONA)</span> </span>
                        <span class="empresacciones"><img src="imagen/editar.svg" border="0"></span>
                    </li>
                    <li onclick="empresa()">
                        <span class="empresafoto"><img src="imagen/empresa.jpg" border="0"></span>
                        <span class="empresaconte">
                            <span class="empresacontea">Empresa de Prueba 2</span>
                            <span class="empresaconteb">C/ Córdoba, 4 Bajo</span>
                            <span class="empresacontec">23400 UBEDA (JAEN)</span> </span>
                        <span class="empresacciones"><img src="imagen/editar.svg" border="0"></span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div id="fconte_2" class="fondoconte" style="display: none;">
        <div class="barra">
            <div class="barraconte">
                <div class="cerrar"><img id="cerrar_2" src="imagen/cerrar.svg" border="0"></div>
            </div>
        </div>
        <div class="contenidos">
            <div class="cabecera"><img src="imagen/buzzo.svg"><br><span>Técnico Cubetic Consultores</span></div>
            <div class="titulo"><span>Empresa</span><span class="subtitulo">Empresa</span></div>
            <div id="fconte_2_contenido">
                <div class="pperfil">
                    <div class="pperfilimagen"><img src="imagen/empresa.jpg" border="0"></div>
                    <div class="pperfildatos">
                        <div class="pperfilnombre">Empresa de prueba</div>
                        <div class="pperfildireccion">Dirección</div>
                        <div class="pperfildireccion" style="color:#888888;">Inicio: XXXX-XX-XX - Fin: XXXX-XX-XX</div>
                    </div>
                </div>
                <div class="oppciones">
                    <ul>
                        <li onclick="trabaja(5965);">
                            <span class="oppcionfoto"><img src="imagen/trabajadores.svg" border="0"></span>
                            <span class="oppcionconte">
                                <span class="oppcioncontea">Trabajadores</span>
                            </span>
                        </li>
                        <li onclick="centros(5965);">
                            <span class="oppcionfoto"><img src="imagen/centrotrabajo.svg" border="0"></span>
                            <span class="oppcionconte">
                                <span class="oppcioncontea">Centros de trabajo</span>
                            </span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    
    <div id='menu'>
        <ul>
            <li>
                <a href='seo.php' class='menuboton'>
                    <span class='menuicono'>
                        <img src='imagen/seo.png' border='0' />
                    </span>
                    <span class='menutextocon'>
                        <span class='menutexto'>SEO</span>
                    </span>
                </a>
            </li>
            <li>
                <a href='proyectos.php' class='menuboton'>
                    <span class='menuicono'>
                        <img src='imagen/proyectos.png' border='0' />
                    </span>
                    <span class='menutextocon'>
                        <span class='menutexto'>Proyectos</span>
                    </span>
                </a>
            </li>
            <li>
                <a href='salir.php' class='menuboton'>
                    <span class='menuicono'>
                        <img src='imagen/menusalir.svg' border='0' />
                    </span>
                    <span class='menutextocon'>
                        <span class='menutexto'>Salir</span>
                    </span>
                </a>
            </li>
        </ul>
    </div>
    <div id='menullama'>
        <img id='menullamaicono' src='imagen/menu.svg' border='0' />
    </div>
    <div id='confirmacionok'>
        <div id='confirmacionokconte'>
            <div id='confirmacionokmensaje'></div>
            <div id='confirmacionokboton'>
                <p>
                    <a href='javascript:void(0);'>Aceptar</a>
                </p>
            </div>
        </div>
    </div>
    <div id='confirmacionerror'>
        <div id='confirmacionerrorconte'>
            <div id='confirmacionerrormensaje'></div>
            <div id='confirmacionerrorboton'>
                <p>
                    <a href='javascript:void(0);'>Aceptar</a>
                </p>
            </div>
        </div>
    </div>
    <div id='confirmacionblanco'>
        <div id='confirmacionblancoconte'>
            <div id='confirmacionblancomensaje'></div>
            <div id='confirmacionblancoboton'>
                <p>
                    <a href='javascript:void(0);'>Aceptar</a>
                </p>
            </div>
        </div>
    </div>
    <div id='confirmacionduda'>
        <div id='confirmaciondudaconte'>
            <div id='confirmaciondudamensaje'></div>
            <div id='confirmaciondudaformulario'></div>
            <div id='confirmaciondudaboton'>
                <p>
                    <span id='confirmaciondudabotonca'></span>
                    <span>
                        <a id='confirmaciondudabotonno' href='javascript:void(0);'>No</a>
                    </span>
                </p>
            </div>
        </div>
    </div>
    <div id='cargando'>
        <div id='cargandoconte'>
            <div class='loader'>
                <img border='0' src='imagen/cargando.svg' />
            </div>
            <div>Procesando....</div>
        </div>
    </div>
    <script src='scripts/proyectos.js' type='text/javascript'></script>
    <script src='scripts/final.js' type='text/javascript'></script>
</body>

</html>