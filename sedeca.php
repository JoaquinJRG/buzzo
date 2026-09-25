<!DOCTYPE html>
<html>

<head>
    <meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
    <title>Buzzo - DeCa</title>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
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
            <div class='titulo'>DeCa</div>
            <div class='servicios'>
                <ul>
                    <li>
                        <span class="servicioconte">
                            <span class="serviciocontea">Empresa de Prueba</span>
                            <span class="servicioconteb">Estado: Finalizado - Caducidad: XXXX-XX-XX</span>
                            <span class="servicioconteopciones">
                                <span class="servicioconteopcion"><img title="Emitir DeCa" alt="Emitir DeCa" onclick="emitirDeca()" border="0" src="imagen/emitirdeca.png"></span>
                                <span class="servicioconteopcion"><img title="Mis DeCa" alt="Mis DeCa" onclick="misDeca()" border="0" src="imagen/misdeca.png"></span>
                                <span class="servicioconteopcion"><img title="Mi agenda" alt="Mi agenda" onclick="miAgenda()" border="0" src="imagen/miagenda.png"></span>
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
                                <div class="campocon"><label for="decaconductoragenda">De mi agenda</label><select id="decaconductoragenda" name="decaconductoragenda" class="campo">
                                        <option value="">— Escribir a mano —</option>
                                        <option value="mis-datos">Mis datos</option>
                                    </select></div>
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
                                <div class="campocon"><label for="decatractoragenda">Tractor de mi agenda</label><select id="decatractoragenda" name="decatractoragenda" class="campo"><option value="">— Escribir a mano —</option></select></div>
                                <div class="campocon"><label for="decaremolqueagenda">Remolque de mi agenda</label><select id="decaremolqueagenda" name="decaremolqueagenda" class="campo"><option value="">— Escribir a mano —</option></select></div>
                            </div>
                            <div class="deca-campos">
                                <div class="campocon"><label for="decamatriculatractor">Matrícula (tractor) *</label><input id="decamatriculatractor" name="decamatriculatractor" class="campo" type="text" required></div>
                                <div class="campocon"><label for="decamatricularemolque">Matrícula remolque <small>(opcional)</small></label><input id="decamatricularemolque" name="decamatricularemolque" class="campo" type="text"></div>
                            </div>
                            <div class="deca-campos">
                                <div class="campocon"><label for="decaautorizacionagenda">Autorización de mi agenda</label><select id="decaautorizacionagenda" name="decaautorizacionagenda" class="campo"><option value="">— Escribir a mano —</option></select></div>
                                <div class="campocon"><label for="decaautorizacion">Autorización especial de circulación <small>(opcional)</small></label><input id="decaautorizacion" name="decaautorizacion" class="campo" type="text"></div>
                            </div>
                        </fieldset>

                        <fieldset id="deca-envio-1">
                            <legend>Envío 1</legend>
                            <div class="deca-envio">
                                <h3>Origen</h3>
                                <div class="campocon"><label for="decaorigenagenda">De mi agenda</label><select id="decaorigenagenda" name="decaorigenagenda" class="campo">
                                        <option value="">— Escribir a mano —</option>
                                    </select></div>
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
                                <div class="campocon"><label for="decadestinoagenda">De mi agenda</label><select id="decadestinoagenda" name="decadestinoagenda" class="campo">
                                        <option value="">— Escribir a mano —</option>
                                    </select></div>
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
                                <div class="campocon"><label for="decafecha">Fecha efectiva del servicio *</label><input id="decafecha" name="decafecha" class="campo" type="text" value="" maxlength="10" autocomplete="off" required></div>
                            </div>
                        </fieldset>
                        <div class="botones">
                            <button id="decaaddenvio" name="decaaddenvio" type="button" value="Añadir otro envío" class="boton">Añadir otro envío</button>
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
                        <fieldset>
                            <legend>Filtros de búsqueda</legend>
                            <div class="deca-campos">
                                <div class="campocon">
                                    <label for="empresalogsdesde">Desde</label>
                                    <input id="empresalogsdesde" name="empresalogsdesde" class="campo" type="text" value="" maxlength="10" autocomplete="off" placeholder="dd/mm/aaaa">
                                </div>
                                <div class="campocon">
                                    <label for="empresalogshasta">Hasta</label>
                                    <input id="empresalogshasta" name="empresalogshasta" class="campo" type="text" value="" maxlength="10" autocomplete="off" placeholder="dd/mm/aaaa">
                                </div>
                            </div>
                            <div class="deca-campos">
                                <div class="campocon">
                                    <label for="empresalogscontraparte">Contraparte</label>
                                    <select id="empresalogscontraparte" name="empresalogscontraparte" class="campo">
                                        <option value="">Todas</option>
                                    </select>
                                </div>
                                <div class="campocon">
                                    <label for="empresalogsmatricula">Matrícula</label>
                                    <input id="empresalogsmatricula" name="empresalogsmatricula" class="campo" type="text" placeholder="Matrícula...">
                                </div>
                            </div>
                        </fieldset>
                        <div class="botones">
                            <button id="empresalogsenvio" name="empresalogsenvio" type="button" value="Buscar" class="boton">Buscar</button>
                            <button id="empresalogsvertodos" name="empresalogsvertodos" type="button" value="Ver todos" class="boton">Ver todos</button>
                        </div>
                    </form>

                </div>
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
            <div id="fconte_1_4_contenido">
                <div class="tituloempresa">Empresa de Prueba</div>
                <div class="deca-agenda">
                    <p class="deca-agenda-ayuda">Guarda tus datos para ahorrarte repetir texto.</p>
                    <div class="deca-agenda-categorias" role="tablist" aria-label="Categorías de la agenda">
                        <button id="decaagendacontrapartes" name="decaagendacontrapartes" type="button" class="deca-agenda-categoria deca-agenda-categoria-activa" role="tab" aria-selected="true">Contrapartes</button>
                        <button id="decaagendadirecciones" name="decaagendadirecciones" type="button" class="deca-agenda-categoria" role="tab" aria-selected="false">Direcciones</button>
                        <button id="decaagendavehiculos" name="decaagendavehiculos" type="button" class="deca-agenda-categoria" role="tab" aria-selected="false">Vehículos</button>
                        <button id="decaagendaconductores" name="decaagendaconductores" type="button" class="deca-agenda-categoria" role="tab" aria-selected="false">Conductores</button>
                        <button id="decaagendaautorizaciones" name="decaagendaautorizaciones" type="button" class="deca-agenda-categoria" role="tab" aria-selected="false">Autorizaciones</button>
                    </div>
                    <div class="botones deca-agenda-acciones">
                        <button id="decaagendaaddcontraparte" name="decaagendaaddcontraparte" type="button" value="Añadir contraparte" class="boton">Añadir contraparte</button>
                        <button id="decaagendaadddireccion" name="decaagendaadddireccion" type="button" value="Añadir dirección" class="boton" style="display:none;">Añadir dirección</button>
                        <button id="decaagendaaddtractora" name="decaagendaaddtractora" type="button" value="Añadir tractora" class="boton" style="display:none;">Añadir tractora</button>
                        <button id="decaagendaaddremolque" name="decaagendaaddremolque" type="button" value="Añadir remolque" class="boton" style="display:none;">Añadir remolque</button>
                        <button id="decaagendaaddconductor" name="decaagendaaddconductor" type="button" value="Añadir conductor" class="boton" style="display:none;">Añadir conductor</button>
                        <button id="decaagendaaddautorizacion" name="decaagendaaddautorizacion" type="button" value="Añadir autorización" class="boton" style="display:none;">Añadir autorización</button>
                    </div>
                    <p id="decaagendaestado" class="deca-agenda-estado">Todavía no tienes contrapartes.</p>
                </div>
            </div>
        </div>
    </div>
    <div id="fconte_1_4_1" class="fondoconte" style="display:none;">
        <div class="barra">
            <div class="barraconte">
                <div class="cerrar">
                    <img id="cerrar_1_4_1" src="imagen/cerrar.svg" border="0">
                </div>
            </div>
        </div>
        <div class="contenidos">
            <div class="cabecera">
                <img src="imagen/buzzo.svg"><br>
                <span>Técnico Cubetic Consultores</span>
            </div>
            <div class="titulo">
                <span>Nueva contraparte</span>
                <span class="subtitulo">DeCa</span>
            </div>
            <div id="fconte_1_4_1_contenido">
                <div class="tituloempresa">Empresa de Prueba</div>
                <div class="formulario">
                    <form id="formulario-deca-contraparte" method="post" action="">
                <div class="campocon">
                    <label for="deca-contraparte-nombre">Nombre *</label>
                    <input id="deca-contraparte-nombre" name="deca-contraparte-nombre" class="campo" type="text" required>
                </div>
                <div class="campocon">
                    <label for="deca-contraparte-nif">NIF *</label>
                    <input id="deca-contraparte-nif" name="deca-contraparte-nif" class="campo" type="text" placeholder="DNI, NIE o CIF" required>
                </div>
                <fieldset>
                    <legend>¿Qué papel juega? *</legend>
                    <div class="campomarca"><label><input name="deca-contraparte-rol-cargador" type="checkbox"> Cargador — me contrata transportes</label></div>
                    <div class="campomarca"><label><input name="deca-contraparte-rol-transportista" type="checkbox"> Transportista — realiza transportes para mí</label></div>
                    <p>Puedes marcar los dos si alterna ambos papeles: una sola ficha por empresa.</p>
                </fieldset>
                <div class="campocon">
                    <label for="deca-contraparte-email">Email</label>
                    <input id="deca-contraparte-email" name="deca-contraparte-email" class="campo" type="email">
                </div>
                <div class="campocon">
                    <label for="deca-contraparte-telefono">Teléfono</label>
                    <input id="deca-contraparte-telefono" name="deca-contraparte-telefono" class="campo" type="tel">
                </div>
                <fieldset>
                    <legend>Domicilio</legend>
                    <div class="campocon">
                        <label for="deca-contraparte-via">Vía</label>
                        <input id="deca-contraparte-via" name="deca-contraparte-via" class="campo" type="text">
                    </div>
                    <div class="deca-campos">
                        <div class="campocon">
                            <label for="deca-contraparte-cp">C.P.</label>
                            <input id="deca-contraparte-cp" name="deca-contraparte-cp" class="campo" type="text" inputmode="numeric" maxlength="5">
                        </div>
                        <div class="campocon">
                            <label for="deca-contraparte-localidad">Localidad</label>
                            <input id="deca-contraparte-localidad" name="deca-contraparte-localidad" class="campo" type="text">
                        </div>
                    </div>
                    <div class="campocon">
                        <label for="deca-contraparte-provincia">Provincia</label>
                        <input id="deca-contraparte-provincia" name="deca-contraparte-provincia" class="campo" type="text">
                    </div>
                </fieldset>
                <div class="campocon">
                    <label for="deca-contraparte-notas">Notas</label>
                    <textarea id="deca-contraparte-notas" name="deca-contraparte-notas" class="campo"></textarea>
                </div>
                <div class="botones">
                    <button type="submit" class="boton">Guardar</button>
                    <button type="button" id="deca-contraparte-cancelar" class="boton">Cancelar</button>
                </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="fconte_1_4_2" class="fondoconte" style="display:none;">
        <div class="barra">
            <div class="barraconte">
                <div class="cerrar">
                    <img id="cerrar_1_4_2" src="imagen/cerrar.svg" border="0">
                </div>
            </div>
            <div id="fconte_1_4_3" class="fondoconte" style="display:none;">
                <div class="barra">
                    <div class="barraconte">
                        <div class="cerrar">
                            <img id="cerrar_1_4_3" src="imagen/cerrar.svg" border="0">
                        </div>
                    </div>
                </div>
                <div class="contenidos">
                    <div class="cabecera">
                        <img src="imagen/buzzo.svg"><br>
                        <span>Técnico Cubetic Consultores</span>
                    </div>
                    <div class="titulo">
                        <span>Nueva tractora</span>
                        <span class="subtitulo">DeCa</span>
                    </div>
                    <div id="fconte_1_4_3_contenido">
                        <div class="tituloempresa">Empresa de Prueba</div>
                        <div class="formulario">
                            <form id="formulario-deca-tractora" method="post" action="">
                                <div class="campocon">
                                    <label for="deca-tractora-matricula">Matrícula *</label>
                                    <input id="deca-tractora-matricula" name="deca-tractora-matricula" class="campo" type="text" placeholder="1234KLM" required>
                                </div>
                                <div class="campocon">
                                    <label for="deca-tractora-descripcion">Descripción</label>
                                    <input id="deca-tractora-descripcion" name="deca-tractora-descripcion" class="campo" type="text" placeholder="«DAF XF», «frigorífico 13,6 m»...">
                                </div>
                                <fieldset>
                                    <legend>¿De quién es? *</legend>
                                    <div class="campomarca"><label><input name="deca-tractora-propiedad" type="radio" value="propio" checked> Mío</label></div>
                                    <div class="campomarca"><label><input name="deca-tractora-propiedad" type="radio" value="contraparte"> De una contraparte</label></div>
                                </fieldset>
                                <div class="campocon">
                                    <label for="deca-tractora-contraparte">Contraparte</label>
                                    <select id="deca-tractora-contraparte" class="campo">
                                        <option value="">— Selecciona una contraparte —</option>
                                    </select>
                                </div>
                                <p>¿Quién conduce este vehículo? Añádelo en la pestaña Conductores y podrás asignarlo aquí.</p>
                                <div class="botones">
                                    <button type="submit" class="boton">Guardar</button>
                                    <button type="button" id="deca-tractora-cancelar" class="boton">Cancelar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div id="fconte_1_4_4" class="fondoconte" style="display:none;">
                <div class="barra">
                    <div class="barraconte">
                        <div class="cerrar">
                            <img id="cerrar_1_4_4" src="imagen/cerrar.svg" border="0">
                        </div>
                    </div>
                </div>
                <div class="contenidos">
                    <div class="cabecera">
                        <img src="imagen/buzzo.svg"><br>
                        <span>Técnico Cubetic Consultores</span>
                    </div>
                    <div class="titulo">
                        <span>Nuevo remolque</span>
                        <span class="subtitulo">DeCa</span>
                    </div>
                    <div id="fconte_1_4_4_contenido">
                        <div class="tituloempresa">Empresa de Prueba</div>
                        <div class="formulario">
                            <form id="formulario-deca-remolque" method="post" action="">
                                <div class="campocon">
                                    <label for="deca-remolque-matricula">Matrícula *</label>
                                    <input id="deca-remolque-matricula" name="deca-remolque-matricula" class="campo" type="text" placeholder="1234KLM" required>
                                </div>
                                <div class="campocon">
                                    <label for="deca-remolque-descripcion">Descripción</label>
                                    <input id="deca-remolque-descripcion" name="deca-remolque-descripcion" class="campo" type="text" placeholder="«DAF XF», «frigorífico 13,6 m»...">
                                </div>
                                <fieldset>
                                    <legend>¿De quién es? *</legend>
                                    <div class="campomarca"><label><input name="deca-remolque-propiedad" type="radio" value="propio" checked> Mío</label></div>
                                    <div class="campomarca"><label><input name="deca-remolque-propiedad" type="radio" value="contraparte"> De una contraparte</label></div>
                                </fieldset>
                                <div class="campocon">
                                    <label for="deca-remolque-contraparte">Contraparte</label>
                                    <select id="deca-remolque-contraparte" class="campo">
                                        <option value="">— Selecciona una contraparte —</option>
                                    </select>
                                </div>
                                <p>¿Quién conduce este vehículo? Añádelo en la pestaña Conductores y podrás asignarlo aquí.</p>
                                <div class="botones">
                                    <button type="submit" class="boton">Guardar</button>
                                    <button type="button" id="deca-remolque-cancelar" class="boton">Cancelar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="contenidos">
            <div class="cabecera">
                <img src="imagen/buzzo.svg"><br>
                <span>Técnico Cubetic Consultores</span>
            </div>
            <div class="titulo">
                <span>Nueva dirección</span>
                <span class="subtitulo">DeCa</span>
            </div>
            <div id="fconte_1_4_2_contenido">
                <div class="tituloempresa">Empresa de Prueba</div>
                <div class="formulario">
                    <form id="formulario-deca-direccion" method="post" action="">
                        <div class="campocon">
                            <label for="deca-direccion-alias">Alias</label>
                            <input id="deca-direccion-alias" name="deca-direccion-alias" class="campo" type="text" placeholder="p. ej. Almacén de León">
                        </div>
                        <div class="campocon">
                            <label for="deca-direccion-empresa">Empresa / titular</label>
                            <input id="deca-direccion-empresa" name="deca-direccion-empresa" class="campo" type="text">
                        </div>
                        <div class="campocon">
                            <label for="deca-direccion-via">Vía *</label>
                            <input id="deca-direccion-via" name="deca-direccion-via" class="campo" type="text" required>
                        </div>
                        <div class="deca-campos">
                            <div class="campocon">
                                <label for="deca-direccion-cp">C.P.</label>
                                <input id="deca-direccion-cp" name="deca-direccion-cp" class="campo" type="text" inputmode="numeric" maxlength="5">
                            </div>
                            <div class="campocon">
                                <label for="deca-direccion-localidad">Localidad *</label>
                                <input id="deca-direccion-localidad" name="deca-direccion-localidad" class="campo" type="text" required>
                            </div>
                        </div>
                        <div class="campocon">
                            <label for="deca-direccion-provincia">Provincia</label>
                            <input id="deca-direccion-provincia" name="deca-direccion-provincia" class="campo" type="text">
                        </div>
                        <div class="campocon">
                            <label for="deca-direccion-contraparte">Contraparte <small>(opcional)</small></label>
                            <select id="deca-direccion-contraparte" name="deca-direccion-contraparte" class="campo">
                                <option value="">— Ninguna (genérica) —</option>
                            </select>
                        </div>
                        <div class="campocon">
                            <label for="deca-direccion-email">Email de contacto</label>
                            <input id="deca-direccion-email" name="deca-direccion-email" class="campo" type="email">
                        </div>
                        <div class="campocon">
                            <label for="deca-direccion-telefono">Teléfono de contacto</label>
                            <input id="deca-direccion-telefono" name="deca-direccion-telefono" class="campo" type="tel" placeholder="612 345 678">
                        </div>
                        <div class="botones">
                            <button type="submit" class="boton">Guardar</button>
                            <button type="button" id="deca-direccion-cancelar" class="boton">Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="fconte_1_4_5" class="fondoconte" style="display:none;">
        <div class="barra">
            <div class="barraconte">
                <div class="cerrar">
                    <img id="cerrar_1_4_5" src="imagen/cerrar.svg" border="0">
                </div>
            </div>
            <div id="fconte_1_4_6" class="fondoconte" style="display:none;">
                <div class="barra">
                    <div class="barraconte">
                        <div class="cerrar">
                            <img id="cerrar_1_4_6" src="imagen/cerrar.svg" border="0">
                        </div>
                    </div>
                </div>
                <div class="contenidos">
                    <div class="cabecera">
                        <img src="imagen/buzzo.svg"><br>
                        <span>Técnico Cubetic Consultores</span>
                    </div>
                    <div class="titulo">
                        <span>Nueva autorización</span>
                        <span class="subtitulo">DeCa</span>
                    </div>
                    <div id="fconte_1_4_6_contenido">
                        <div class="tituloempresa">Empresa de Prueba</div>
                        <div class="formulario">
                            <form id="formulario-deca-autorizacion" method="post" action="">
                                <div class="campocon">
                                    <label for="deca-autorizacion-nombre">Nombre *</label>
                                    <input id="deca-autorizacion-nombre" name="deca-autorizacion-nombre" class="campo" type="text" placeholder="NIMA" required>
                                </div>
                                <div class="campocon">
                                    <label for="deca-autorizacion-codigo">Código *</label>
                                    <input id="deca-autorizacion-codigo" name="deca-autorizacion-codigo" class="campo" type="text" placeholder="ES123ABC" required>
                                </div>
                                <p>El nombre es alfanumérico y se guarda en mayúsculas. El código admite texto libre.</p>
                                <fieldset>
                                    <legend>¿De quién es? *</legend>
                                    <div class="campomarca"><label><input name="deca-autorizacion-propiedad" type="radio" value="propio" checked> Mía</label></div>
                                    <div class="campomarca"><label><input name="deca-autorizacion-propiedad" type="radio" value="contraparte"> De una contraparte</label></div>
                                </fieldset>
                                <div class="campocon">
                                    <label for="deca-autorizacion-contraparte">Contraparte</label>
                                    <select id="deca-autorizacion-contraparte" class="campo">
                                        <option value="">— Selecciona una contraparte —</option>
                                    </select>
                                </div>
                                <div class="botones">
                                    <button type="submit" class="boton">Guardar</button>
                                    <button type="button" id="deca-autorizacion-cancelar" class="boton">Cancelar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="contenidos">
            <div class="cabecera">
                <img src="imagen/buzzo.svg"><br>
                <span>Técnico Cubetic Consultores</span>
            </div>
            <div class="titulo">
                <span>Nuevo conductor</span>
                <span class="subtitulo">DeCa</span>
            </div>
            <div id="fconte_1_4_5_contenido">
                <div class="tituloempresa">Empresa de Prueba</div>
                <div class="formulario">
                    <form id="formulario-deca-conductor" method="post" action="">
                        <div class="campocon">
                            <label for="deca-conductor-nombre">Nombre *</label>
                            <input id="deca-conductor-nombre" name="deca-conductor-nombre" class="campo" type="text" required>
                        </div>
                        <div class="campocon">
                            <label for="deca-conductor-telefono">Teléfono *</label>
                            <input id="deca-conductor-telefono" name="deca-conductor-telefono" class="campo" type="tel" inputmode="tel" placeholder="612 345 678" required>
                        </div>
                        <p>El teléfono permite «Compartir» desde la ficha del DeCA directamente por WhatsApp. Sin prefijo se asume España (+34).</p>
                        <div class="campocon">
                            <label for="deca-conductor-notas">Notas</label>
                            <textarea id="deca-conductor-notas" name="deca-conductor-notas" class="campo"></textarea>
                        </div>
                        <div class="botones">
                            <button type="submit" class="boton">Guardar</button>
                            <button type="button" id="deca-conductor-cancelar" class="boton">Cancelar</button>
                        </div>
                    </form>
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
                <a href='sedeca.php' class='menuboton'>
                    <span class='menuicono'>
                        <img src='imagen/sedeca.png' border='0' />
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
    <script src='scripts/deca.js' type='text/javascript'></script>
    <script src='scripts/final.js' type='text/javascript'></script>
</body>

</html>