<div class="modal fade" id="modalComentarios" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Comentario/Observaciones</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>


            <div class="modal-body">
                <div class="col-md" data-spy="scroll">
                    <div class="card text-white bg-danger mb-3" style="max-width: 15rem;">
                        <div class="card-body">
                            <p>Admin</p>
                            <p class="card-text">Mesaje</p>
                        </div>
                    </div>
                    <div class="card text-white bg-danger mb-3" style="max-width: 15rem;">
                        <div class="card-body">
                            <p>Admin</p>
                            <p class="card-text">Mesaje</p>
                        </div>
                    </div>

                    <div class="card text-white bg-danger mb-3" style="max-width: 15rem;">
                        <div class="card-body">
                            <p>Admin</p>
                            <p class="card-text">Mesaje</p>
                        </div>
                    </div>
                    <div class="card text-white bg-danger mb-3" style="max-width: 15rem;">
                        <div class="card-body">
                            <p>Admin</p>
                            <p class="card-text">Mesaje</p>
                        </div>
                    </div>
                </div>

                <form method="POST" action="">
                    <input type="hidden" id="matricula" name="matricula" value="">
                    <input type="hidden" id="id_tipopuntos" name="id_tipopuntos" value="">
                    <input type="hidden" id="id_actividad" name="id_actividad" value="">
                    <input type="hidden" id="id_puntos" name="id_puntos" value="">
                    <input type="hidden" id="accion" name="accion" value="">
                    <div class="col-md">
                        <div class="form-group">
                            <label for="textDescripcion">Comentario: </label>
                            <textarea class="form-control" id="textComentario" rows="3" name="description-repo" maxlength="180" minlength="10" required></textarea>
                        </div>
                    </div>
            </div>
            <p id="mensaje" style="color: #FF0000" value=""></p>
            <div class="modal-footer">
                <button type="submit" class="btn btn-warning" data-dismiss="modal" id="guardarPuntos">guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>