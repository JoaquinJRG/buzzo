<!DOCTYPE html>
<html>

<head>
    <meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
    <title>Buzzo - SEO</title>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
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
            <div class='titulo'>SEO</div>
            <div class='servicios'>
                <ul>
                    <li>
                        <span class="servicioconte">
                            <span class="serviciocontea">Empresa de Prueba</span>
                            <span class="servicioconteb">Estado: Finalizado - Caducidad: XXXX-XX-XX</span>
                            <span class="servicioconteopciones">
                                <span class="servicioconteopcion"><img title="Estadisticas" alt="Estadisticas" onclick="seopalabras();" border="0" src="imagen/estadisticas.png"></span>
                                <span class="servicioconteopcion"><img title="Historico" alt="Historico" onclick="seohistorico();" border="0" src="imagen/historico.png"></span>
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
                <span>Estadísticas</span>
                <span class="subtitulo">SEO</span>
            </div>
            <div id="fconte_1_1_contenido">
                <div class="tituloempresa">Empresa de Prueba</div>
                <div class="tituloempresa">
                    <h4>Top 10 keywords por volumen</h4>
                    <canvas class="" id="graficoVolumenBusqueda"></canvas>
                </div>
                <div class="tituloempresa">
                    <h4>Distribución del ranking orgánico</h4>
                    <canvas id="graficoOrganico"></canvas>
                </div>
                <div class="tituloempresa">
                    <h4>Top keywords por tráfico</h4>
                    <canvas id="graficoTrafico"></canvas>
                </div>
                <div class="tituloempresa">
                    <h4>Competencia (KW comunes)</h4>
                    <canvas id="graficoCompetencia"></canvas>
                </div>

                <div class="tituloempresa">Top 10 por volumen de búsqueda</div>
                <table class="gridtable" id="listadovolumenbusqueda">
                    <thead>
                        <tr>
                            <th>Keyword</th>
                            <th>Posición</th>
                            <th>Vol.</th>
                            <th>Tráfico est.</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                    <tfoot>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>Total: <span id="listadovolumenbusquedaselec"></span> / <span id="listadovolumenbusquedartotal"></span></td>
                        </tr>
                    </tfoot>
                </table>

                <div class="tituloempresa">Top 10 por mejor posición</div>
                <table class="gridtable" id="listadomejorposicion">
                    <thead>
                        <tr>
                            <th>Keyword</th>
                            <th>Posición</th>
                            <th>Vol.</th>
                            <th>Tráfico est.</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                    <tfoot>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>Total: <span id="listadomejorposicionselec"></span> / <span id="listadomejorposicionrtotal"></span></td>
                        </tr>
                    </tfoot>
                </table>

                <div class="tituloempresa">Competencia</div>
                <table class="gridtable" id="listadocompetencia">
                    <thead>
                        <tr>
                            <th>URL</th>
                            <th>Palabras clave comunes</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                    <tfoot>
                        <tr>
                            <td></td>
                            <td>Total: <span id="listadocompetenciaselec"></span></td>
                        </tr>
                    </tfoot>
                </table>

                <div class="tituloempresa">Páginas con más tráfico</div>
                <table class="gridtable" id="listadopaginas">
                    <thead>
                        <tr>
                            <th>URL</th>
                            <th>Tráfico</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                    <tfoot>
                        <tr>
                            <td></td>
                            <td>Total: <span id="listadopaginasselec"></span> / <span id="listadopaginastotal"></span></td>
                        </tr>
                    </tfoot>
                </table>
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
                <span>Histórico</span>
                <span class="subtitulo">SEO</span>
            </div>
            <div id="fconte_1_2_contenido">
                <div class="tituloempresa">Empresa de Prueba</div>
                <div class="historico-panel">
                    <div class="historico-toolbar">
                        <div class="historico-metricas" role="tablist" aria-label="Métrica del histórico">
                            <button class="historico-metrica activa" type="button" data-metrica="traffic_sum" role="tab" aria-selected="true">Tráfico total</button>
                            <button class="historico-metrica" type="button" data-metrica="keywords_count" role="tab" aria-selected="false">Keywords</button>
                            <button class="historico-metrica" type="button" data-metrica="price_sum" role="tab" aria-selected="false">Coste tráfico</button>
                        </div>
                        <div class="historico-periodos" role="group" aria-label="Periodo del histórico">
                            <button class="historico-periodo" type="button" data-meses="6">6m</button>
                            <button class="historico-periodo" type="button" data-meses="12">1a</button>
                            <button class="historico-periodo" type="button" data-meses="24">2a</button>
                            <button class="historico-periodo activo" type="button" data-meses="0">Todos</button>
                        </div>
                    </div>
                    <div class="historico-grafico">
                        <canvas id="graficoHistorico"></canvas>
                    </div>
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
                <a href='partes.php' class='menuboton'>
                    <span class='menuicono'>
                        <img src='imagen/partes.png' border='0' />
                    </span>
                    <span class='menutextocon'>
                        <span class='menutexto'>Partes</span>
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
    <script src='scripts/seo.js' type='text/javascript'></script>
    <script src='scripts/final.js' type='text/javascript'></script>
</body>

</html>