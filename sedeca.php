<!DOCTYPE html>
<html>

<head>
    <meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
    <title>Buzzo - SEO</title>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="stylesheet" href="css/seo.css">
    <link rel="stylesheet" href="css/deca.css">
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
            <div class='titulo'>DeCA</div>
            <div class='servicios'>
                <ul>
                    <li>
                        <span class="servicioconte">
                            <span class="serviciocontea">Empresa de Prueba</span>
                            <span class="servicioconteb">Estado: Finalizado - Caducidad: XXXX-XX-XX</span>
                            <span class="servicioconteopciones">
                                <span class="servicioconteopcion"><img title="Emitir deca" alt="Emitir deca" onclick="emitirDeca()" border="0" src="imagen/"></span>
                                <span class="servicioconteopcion"><img title="Mis deca" alt="Mis deca" onclick="misDeca()" border="0" src="imagen/"></span>
                                <span class="servicioconteopcion"><img title="Deca de terceros" alt="Deca de terceros" onclick="decaTerceros()" border="0" src="imagen/"></span>
                                <span class="servicioconteopcion"><img title="Mis agenda" alt="Mis agendas" onclick="miAgenda()" border="0" src="imagen/"></span>
                            </span>
                        </span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div id="fconte_1_1" class="fondoconte" style="display:none;">
        <div class="barra">
            <div class="barraconte">
                <div class="cerrar">
                    <img id="cerrar_1_1" src="imagen/cerrar.svg" border="0">
                </div>
            </div>
        </div>
        <div class="contenidos">
            <div class="cabecera">
                <img src="imagen/buzzo.svg"><br>
                <span>Técnico Cubetic Consultores</span>
            </div>
            <div class="titulo">
                <span>Emitir DeCa</span>
                <span class="subtitulo">DeCa</span>
            </div>
            <div id="fconte_1_1_contenido">
                <div class="tituloempresa">Empresa de Prueba</div>
                <div class="formulario">
                    <form id="formularioemisiondeca" name="formularioemisiondeca" method="post" action="">
                        <fieldset>
                            <legend>Partes del servicio</legend>
                            <div class="deca-grid">
                                <div class="deca-bloque">
                                    <h3>Cargador contractual <small>(quien contrata)</small></h3>
                                    <div class="campocon">
                                        <label for="decacargadoragenda">De mi agenda</label>
                                        <select id="decacargadoragenda" name="decacargadoragenda" class="campo">
                                            <option value="">— Escribir a mano —</option>
                                            <option value="mis-datos">Mis datos</option>
                                        </select>
                                    </div>
                                    <div class="deca-campos">
                                        <div class="campocon"><label for="decacargadornombre">Nombre / razón social *</label><input id="decacargadornombre" name="decacargadornombre" class="campo" type="text" required></div>
                                        <div class="campocon"><label for="decacargadornif">NIF/CIF *</label><input id="decacargadornif" name="decacargadornif" class="campo" type="text" required></div>
                                    </div>
                                    <div class="campocon"><label for="decacargadorvia">Domicilio (vía) *</label><input id="decacargadorvia" name="decacargadorvia" class="campo" type="text" required></div>
                                    <div class="deca-campos">
                                        <div class="campocon"><label for="decacargadorlocalidad">Localidad *</label><input id="decacargadorlocalidad" name="decacargadorlocalidad" class="campo" type="text" required></div>
                                        <div class="campocon"><label for="decacargadorprovincia">Provincia *</label><input id="decacargadorprovincia" name="decacargadorprovincia" class="campo" type="text" required></div>
                                    </div>
                                    <div class="deca-campos">
                                        <div class="campocon"><label for="decacargadorcp">Código postal *</label><input id="decacargadorcp" name="decacargadorcp" class="campo" type="text" inputmode="numeric" maxlength="5" required></div>
                                        <div class="campocon"><label for="decacargadoremail">Email <small>(para enviarle copia)</small></label><input id="decacargadoremail" name="decacargadoremail" class="campo" type="email"></div>
                                    </div>
                                </div>
                                <div class="deca-bloque">
                                    <h3>Transportista efectivo <small>(quien realiza el viaje)</small></h3>
                                    <div class="campocon">
                                        <label for="decatransportistaagenda">De mi agenda</label>
                                        <select id="decatransportistaagenda" name="decatransportistaagenda" class="campo">
                                            <option value="">— Escribir a mano —</option>
                                            <option value="mis-datos">Mis datos</option>
                                        </select>
                                    </div>
                                    <div class="deca-campos">
                                        <div class="campocon"><label for="decatransportistanombre">Nombre / razón social *</label><input id="decatransportistanombre" name="decatransportistanombre" class="campo" type="text" required></div>
                                        <div class="campocon"><label for="decatransportistanif">NIF/CIF *</label><input id="decatransportistanif" name="decatransportistanif" class="campo" type="text" required></div>
                                    </div>
                                    <div class="campocon"><label for="decatransportistavia">Domicilio (vía) *</label><input id="decatransportistavia" name="decatransportistavia" class="campo" type="text" required></div>
                                    <div class="deca-campos">
                                        <div class="campocon"><label for="decatransportistalocalidad">Localidad *</label><input id="decatransportistalocalidad" name="decatransportistalocalidad" class="campo" type="text" required></div>
                                        <div class="campocon"><label for="decatransportistaprovincia">Provincia *</label><input id="decatransportistaprovincia" name="decatransportistaprovincia" class="campo" type="text" required></div>
                                    </div>
                                    <div class="deca-campos">
                                        <div class="campocon"><label for="decatransportistacp">Código postal *</label><input id="decatransportistacp" name="decatransportistacp" class="campo" type="text" inputmode="numeric" maxlength="5" required></div>
                                        <div class="campocon"><label for="decatransportistaemail">Email <small>(para enviarle copia)</small></label><input id="decatransportistaemail" name="decatransportistaemail" class="campo" type="email"></div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>

                        <fieldset>
                            <legend>Conductor</legend>
                            <div class="deca-campos">
                                <div class="campocon"><label for="decaconductoragenda">De mi agenda</label><select id="decaconductoragenda" name="decaconductoragenda" class="campo"><option value="">— Escribir a mano —</option><option value="mis-datos">Mis datos</option></select></div>
                                <div class="campocon"><label for="decaconductornombre">Nombre completo *</label><input id="decaconductornombre" name="decaconductornombre" class="campo" type="text" required></div>
                            </div>
                            <div class="deca-campos deca-campos-3">
                                <div class="campocon"><label for="decaconductordni">DNI/NIE *</label><input id="decaconductordni" name="decaconductordni" class="campo" type="text" required></div>
                                <div class="campocon"><label for="decaconductoremail">Correo electrónico <small>(si es externo)</small></label><input id="decaconductoremail" name="decaconductoremail" class="campo" type="email"></div>
                                <div class="campocon"><label for="decaconductortelefono">Teléfono <small>(si es externo)</small></label><input id="decaconductortelefono" name="decaconductortelefono" class="campo" type="tel" inputmode="tel"></div>
                            </div>
                        </fieldset>

                        <fieldset>
                            <legend>Vehículo</legend>
                            <div class="deca-campos">
                                <div class="campocon"><label for="decamatriculatractor">Matrícula (tractor) *</label><input id="decamatriculatractor" name="decamatriculatractor" class="campo" type="text" required></div>
                                <div class="campocon"><label for="decamatricularemolque">Matrícula remolque <small>(opcional)</small></label><input id="decamatricularemolque" name="decamatricularemolque" class="campo" type="text"></div>
                            </div>
                            <div class="campocon"><label for="decaautorizacion">Autorización especial de circulación <small>(opcional)</small></label><input id="decaautorizacion" name="decaautorizacion" class="campo" type="text"></div>
                        </fieldset>

                        <fieldset>
                            <legend>Envío 1</legend>
                            <div class="deca-envio">
                                <h3>Origen</h3>
                                <div class="campocon"><label for="decaorigenagenda">De mi agenda</label><select id="decaorigenagenda" name="decaorigenagenda" class="campo"><option value="">— Escribir a mano —</option></select></div>
                                <div class="campocon"><label for="decaorigenempresa">Nombre de la empresa <small>(opcional)</small></label><input id="decaorigenempresa" name="decaorigenempresa" class="campo" type="text"></div>
                                <div class="deca-campos">
                                    <div class="campocon"><label for="decaorigenvia">Vía *</label><input id="decaorigenvia" name="decaorigenvia" class="campo" type="text" required></div>
                                    <div class="campocon"><label for="decaorigenlocalidad">Localidad *</label><input id="decaorigenlocalidad" name="decaorigenlocalidad" class="campo" type="text" required></div>
                                </div>
                                <div class="deca-campos">
                                    <div class="campocon"><label for="decaorigenprovincia">Provincia *</label><input id="decaorigenprovincia" name="decaorigenprovincia" class="campo" type="text" required></div>
                                    <div class="campocon"><label for="decaorigencp">Código postal *</label><input id="decaorigencp" name="decaorigencp" class="campo" type="text" inputmode="numeric" maxlength="5" required></div>
                                </div>
                            </div>
                            <div class="deca-envio">
                                <h3>Destino</h3>
                                <div class="campocon"><label for="decadestinoagenda">De mi agenda</label><select id="decadestinoagenda" name="decadestinoagenda" class="campo"><option value="">— Escribir a mano —</option></select></div>
                                <div class="campocon"><label for="decadestinoempresa">Nombre de la empresa <small>(opcional)</small></label><input id="decadestinoempresa" name="decadestinoempresa" class="campo" type="text"></div>
                                <div class="deca-campos">
                                    <div class="campocon"><label for="decadestinovia">Vía *</label><input id="decadestinovia" name="decadestinovia" class="campo" type="text" required></div>
                                    <div class="campocon"><label for="decadestinolocalidad">Localidad *</label><input id="decadestinolocalidad" name="decadestinolocalidad" class="campo" type="text" required></div>
                                </div>
                                <div class="deca-campos">
                                    <div class="campocon"><label for="decadestinoprovincia">Provincia *</label><input id="decadestinoprovincia" name="decadestinoprovincia" class="campo" type="text" required></div>
                                    <div class="campocon"><label for="decadestinocp">Código postal *</label><input id="decadestinocp" name="decadestinocp" class="campo" type="text" inputmode="numeric" maxlength="5" required></div>
                                </div>
                            </div>
                            <div class="deca-envio">
                                <h3>Mercancía y fecha</h3>
                                <div class="campocon"><label for="decamercancianaturaleza">Naturaleza</label><input id="decamercancianaturaleza" name="decamercancianaturaleza" class="campo" type="text" placeholder="Descripción de la mercancía"></div>
                                <p class="deca-ayuda">Indica al menos uno: peso, bultos o volumen.</p>
                                <div class="deca-campos deca-campos-3">
                                    <div class="campocon"><label for="decapeso">Peso (kg)</label><input id="decapeso" name="decapeso" class="campo" type="number" min="0" step="0.01"></div>
                                    <div class="campocon"><label for="decabultos">Bultos</label><input id="decabultos" name="decabultos" class="campo" type="number" min="0" step="1"></div>
                                    <div class="campocon"><label for="decavolumen">Volumen (m³)</label><input id="decavolumen" name="decavolumen" class="campo" type="number" min="0" step="0.01"></div>
                                </div>
                                <div class="campocon"><label for="decafecha">Fecha efectiva del servicio *</label><input id="decafecha" name="decafecha" class="campo" type="date" required></div>
                            </div>
                        </fieldset>
                        <div class="botones">
                            <button id="decaenvio" name="decaenvio" type="submit" value="Emitir" class="boton">Emitir DeCa</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="fconte_1_2" class="fondoconte" style="display:none;">
        <div class="barra">
            <div class="barraconte">
                <div class="cerrar">
                    <img id="cerrar_1_2" src="imagen/cerrar.svg" border="0">
                </div>
            </div>
        </div>
        <div class="contenidos">
            <div class="cabecera">
                <img src="imagen/buzzo.svg"><br>
                <span>Técnico Cubetic Consultores</span>
            </div>
            <div class="titulo">
                <span>Mis DeCa</span>
                <span class="subtitulo">DeCa</span>
            </div>
            <div id="fconte_1_2_contenido">
                <div class="tituloempresa">Empresa de Prueba</div>
                <div class="formulario">

                    <form id="formularioempresalogs" name="formularioempresalogs" method="post" action="mod_empresas2.php">

                        <div class="campocon"><label for="empresalogsdesde">Desde *</label><input id="empresalogsdesde" name="empresalogsdesde" class="campo hasDatepicker" type="text" value="2026-09-16" maxlength="10"></div>
                        <div class="campocon"><label for="empresalogshasta">Hasta *</label><input id="empresalogshasta" name="empresalogshasta" class="campo hasDatepicker" type="text" value="2026-09-23" maxlength="10"></div>

                        <input id="empresalogsidentif" name="empresalogsidentif" type="hidden" value="nbngiubd3fvbj6b473nfd3nvdg">
                        <input id="empresalogsidentib" name="empresalogsidentib" type="hidden" value="f414624d5aeab684d6cb8ae54e318065">
                        <input id="empresalogscualo" name="empresalogscualo" type="hidden" value="1758">
                        <div class="botones">
                            <button id="empresalogsenvio" name="empresalogsenvio" type="button" value="Buscar" class="boton" onclick="empresalogs(1758);">Buscar</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <div id="fconte_1_3" class="fondoconte" style="display:none;">
        <div class="barra">
            <div class="barraconte">
                <div class="cerrar">
                    <img id="cerrar_1_3" src="imagen/cerrar.svg" border="0">
                </div>
            </div>
        </div>
        <div class="contenidos">
            <div class="cabecera">
                <img src="imagen/buzzo.svg"><br>
                <span>Técnico Cubetic Consultores</span>
            </div>
            <div class="titulo">
                <span>DeCa activos de terceros</span>
                <span class="subtitulo">DeCa</span>
            </div>
            <div id="fconte_1_3_contenido">
                <div class="tituloempresa">Empresa de Prueba</div>
            </div>
        </div>
    </div>
    <div id="fconte_1_4" class="fondoconte" style="display:none;">
        <div class="barra">
            <div class="barraconte">
                <div class="cerrar">
                    <img id="cerrar_1_4" src="imagen/cerrar.svg" border="0">
                </div>
            </div>
        </div>
        <div class="contenidos">
            <div class="cabecera">
                <img src="imagen/buzzo.svg"><br>
                <span>Técnico Cubetic Consultores</span>
            </div>
            <div class="titulo">
                <span>Mi agenda</span>
                <span class="subtitulo">DeCa</span>
            </div>
            <div id="fconte_1_3_contenido">
                <div class="tituloempresa">Empresa de Prueba</div>
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
                <a href='sedeca.php' class='menuboton'>
                    <span class='menuicono'>
                        <img src='imagen/seo.png' border='0' />
                    </span>
                    <span class='menutextocon'>
                        <span class='menutexto'>DeCa</span>
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.5.1/dist/chart.umd.min.js"></script>
    <script src='scripts/deca.js' type='text/javascript'></script>
    <script src='scripts/final.js' type='text/javascript'></script>
</body>

</html>