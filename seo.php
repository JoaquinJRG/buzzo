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
                <div class="tituloempresa estadistica-grafico estadistica-grafico-horizontal">
                    <h4>Top 10 keywords por volumen <span class="seo-ayuda" tabindex="0" role="img" aria-label="Ayuda sobre el volumen de búsqueda">?<span class="seo-ayuda-texto">Muestra las 10 palabras clave con mayor volumen de búsquedas estimado y su posición actual.</span></span></h4>
                    <div class="estadistica-grafico-contenedor"><canvas id="graficoVolumenBusqueda"></canvas></div>
                </div>
                <div class="tituloempresa estadistica-grafico">
                    <h4>Distribución del ranking orgánico <span class="seo-ayuda" tabindex="0" role="img" aria-label="Ayuda sobre la distribución del ranking orgánico">?<span class="seo-ayuda-texto">Indica cuántas palabras clave se encuentran en cada intervalo de posiciones de los resultados orgánicos.</span></span></h4>
                    <div class="estadistica-grafico-contenedor"><canvas id="graficoOrganico"></canvas></div>
                </div>
                <div class="tituloempresa estadistica-grafico estadistica-grafico-horizontal">
                    <h4>Top keywords por tráfico <span class="seo-ayuda" tabindex="0" role="img" aria-label="Ayuda sobre las keywords con más tráfico">?<span class="seo-ayuda-texto">Muestra las palabras clave que generan más tráfico orgánico estimado hacia el dominio.</span></span></h4>
                    <div class="estadistica-grafico-contenedor"><canvas id="graficoTrafico"></canvas></div>
                </div>
                <div class="tituloempresa estadistica-grafico">
                    <h4>Competencia (KW comunes) <span class="seo-ayuda" tabindex="0" role="img" aria-label="Ayuda sobre la competencia">?<span class="seo-ayuda-texto">Compara el dominio con otros sitios que comparten palabras clave y muestra el número de keywords comunes.</span></span></h4>
                    <div class="estadistica-grafico-contenedor"><canvas id="graficoCompetencia"></canvas></div>
                </div>

                <div class="tituloempresa seo-titulo-ayuda">Top 10 por volumen de búsqueda <span class="seo-ayuda" tabindex="0" role="img" aria-label="Ayuda sobre la tabla de volumen de búsqueda">?<span class="seo-ayuda-texto">Detalle de las 10 keywords con mayor volumen estimado, incluyendo posición, volumen y tráfico estimado.</span></span></div>
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

                <div class="tituloempresa seo-titulo-ayuda">Top 10 por mejor posición <span class="seo-ayuda" tabindex="0" role="img" aria-label="Ayuda sobre la tabla de mejor posición">?<span class="seo-ayuda-texto">Detalle de las keywords que ocupan las mejores posiciones orgánicas del dominio.</span></span></div>
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

                <div class="tituloempresa seo-titulo-ayuda">Competencia <span class="seo-ayuda" tabindex="0" role="img" aria-label="Ayuda sobre la tabla de competencia">?<span class="seo-ayuda-texto">Lista los dominios competidores y la cantidad de palabras clave que ambos sitios tienen en común.</span></span></div>
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

                <div class="tituloempresa seo-titulo-ayuda">Páginas con más tráfico <span class="seo-ayuda" tabindex="0" role="img" aria-label="Ayuda sobre la tabla de páginas con más tráfico">?<span class="seo-ayuda-texto">Muestra las páginas del dominio que concentran más tráfico orgánico estimado.</span></span></div>
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
                <div class="historico-resumen">
                    <div class="historico-tarjetas">
                        <div class="historico-tarjeta">
                            <div class="historico-tarjeta-titulo">Autoridad <span class="seo-ayuda" tabindex="0" role="img" aria-label="Ayuda sobre la autoridad">?<span class="seo-ayuda-texto">Mide la fuerza y confianza que los enlaces aportan al dominio y a sus páginas.</span></span></div>
                            <div class="historico-dato"><span>Domain Trust</span><strong id="historicoDomainTrust">—</strong></div>
                            <div class="historico-dato"><span>Page Trust</span><strong id="historicoPageTrust">—</strong></div>
                        </div>
                        <div class="historico-tarjeta">
                            <div class="historico-tarjeta-titulo">Tráfico orgánico <span class="seo-ayuda" tabindex="0" role="img" aria-label="Ayuda sobre el tráfico orgánico">?<span class="seo-ayuda-texto">Visitas estimadas procedentes de resultados no pagados de los buscadores.</span></span></div>
                            <div class="historico-valor" id="historicoOrganicoTraffic">—</div>
                            <div class="historico-unidad">Clics/mes</div>
                            <div class="historico-dato"><span>Palabras clave</span><strong id="historicoOrganicoKeywords">—</strong></div>
                            <div class="historico-dato"><span>Coste tráfico</span><strong id="historicoOrganicoPrice">—</strong></div>
                        </div>
                        <div class="historico-tarjeta">
                            <div class="historico-tarjeta-titulo">Tráfico de pago <span class="seo-ayuda" tabindex="0" role="img" aria-label="Ayuda sobre el tráfico de pago">?<span class="seo-ayuda-texto">Visitas estimadas procedentes de campañas y anuncios pagados.</span></span></div>
                            <div class="historico-valor" id="historicoPagoTraffic">—</div>
                            <div class="historico-unidad">Clics/mes</div>
                            <div class="historico-dato"><span>Keywords de pago</span><strong id="historicoPagoKeywords">—</strong></div>
                            <div class="historico-dato"><span>Coste tráfico</span><strong id="historicoPagoPrice">—</strong></div>
                        </div>
                        <div class="historico-tarjeta">
                            <div class="historico-tarjeta-titulo">Backlinks <span class="seo-ayuda" tabindex="0" role="img" aria-label="Ayuda sobre los backlinks">?<span class="seo-ayuda-texto">Enlaces externos que apuntan al dominio y ayudan a evaluar su popularidad.</span></span></div>
                            <div class="historico-dato"><span>Dominios de referencia</span><strong id="historicoRefdomains">—</strong></div>
                            <div class="historico-dato"><span>Backlinks</span><strong id="historicoBacklinks">—</strong></div>
                        </div>
                    </div>
                </div>
                <div class="historico-panel">
                    <div class="historico-toolbar">
                        <div class="historico-metricas" role="tablist" aria-label="Métrica del histórico">
                            <button class="historico-metrica activa" type="button" data-metrica="traffic_sum" role="tab" aria-selected="true">Tráfico total <span class="seo-ayuda" tabindex="0" role="img" aria-label="Ayuda sobre el tráfico total">?<span class="seo-ayuda-texto">Suma del tráfico orgánico y de pago estimado para cada mes.</span></span></button>
                            <button class="historico-metrica" type="button" data-metrica="keywords_count" role="tab" aria-selected="false">Keywords <span class="seo-ayuda" tabindex="0" role="img" aria-label="Ayuda sobre las keywords">?<span class="seo-ayuda-texto">Número de palabras clave posicionadas, separando el tráfico orgánico y de pago.</span></span></button>
                            <button class="historico-metrica" type="button" data-metrica="price_sum" role="tab" aria-selected="false">Coste tráfico <span class="seo-ayuda" tabindex="0" role="img" aria-label="Ayuda sobre el coste del tráfico">?<span class="seo-ayuda-texto">Valor económico estimado del tráfico generado en cada mes.</span></span></button>
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