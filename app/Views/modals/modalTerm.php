<div class="modal fade" id="modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="modalLabel" class="modal-title">Política de Privacidad</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">
                <p>
                    Esta Política de privacidad describe cómo se recopila, utiliza y comparte su información personal cuando visita o navega por el Sitio Web.
                </p>
                <p>
                    Recopilamos información del dispositivo utilizando las siguientes tecnologías:
                </p>
                <p>
                    - Las "cookies" son archivos de datos que se colocan en su dispositivo o computadora y que a menudo incluyen un identificador único anónimo. Para obtener más información sobre las cookies y cómo deshabilitarlas, visite http://www.allaboutcookies.org.
                </p>
                <p>
                    Recopilamos cierta información suya, como su Nombre y Apellidos, dirección de correo electrónico, número de teléfono <span class="small">(opcional)</span>. Nos referimos a esta información como "Información Mínima Necesaria".
                </p>
                <h5>¿COMO USAMOS TU INFORMACIÓN PERSONAL?</h5>
                <p>
                    Utilizamos la Información que recopilamos generalmente para:
                </p>
                <p>
                    - Comunicación.
                </p>
                <h5>TUS DERECHOS</h5>
                <p>
                    Si usted es un residente europeo, tiene derecho a acceder a la información personal que tenemos sobre usted y a solicitar que su información personal se corrija, actualice o elimine. Si desea ejercer este derecho, contáctenos.
                </p>
    
                <h5>MENORES</h5>
                <p>
                    El sitio no está destinado a personas menores de la edad de 18 años.
                </p>

                <p>
                    Podemos actualizar esta política de privacidad de vez en cuando para reflejar, por ejemplo, cambios en nuestras prácticas o por otras razones operativas, legales o reglamentarias.</p>
                <p>
                    [Re: Oficial de Cumplimiento de Privacidad]
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#modal').modal('show');
        $('#modal').on('hidden.bs.modal', function(event) {
            $('#main-modal').html('');
        });
    });
</script>