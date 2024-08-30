<form action="" id="FRegCliente">
    <div class="modal-header">
        <h4 class="modal-title">Registro Nuevo Cliente</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">

    <div class="form-group">
        <label for="exampleInputBorder">Razón Social</label>
        <input type="text" class="form-control" placeholder="" name="razon" id="razon">
    </div>
    <div class="form-group">
        <label for="exampleInputBorder">NIT</label>
        <input type="text" class="form-control" placeholder="" name="nit" id="nit">
    </div>
    <div class="form-group">
        <label for="exampleInputBorder">Dirección</label>
        <input type="text" class="form-control" placeholder="" name="direccion" id="direccion">
    </div>
    <div class="form-group">
        <label for="exampleInputBorder">Nombre</label>
        <input type="text" class="form-control" placeholder="" name="nombre" id="nombre">
    </div>
    <div class="form-group">
        <label for="exampleInputBorder">Teléfono</label>
        <input type="text" class="form-control" placeholder="" name="telefono" id="telefono">
    </div>
    <div class="form-group">
        <label for="exampleInputBorder">Email</label>
        <input type="text" class="form-control" placeholder="" name="email" id="email">
    </div>

    </div>
    <div class="modal-footer justify-content-between">
    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
    <button type="submit" class="btn btn-primary">Guardar</button>
    </div>
</form>

<script>
$(function () {
  $.validator.setDefaults({
    submitHandler: function () {
      regCliente()
    }
  });
  $('#FRegCliente').validate({
    rules: {
      razon: {
        required: true,
        minlength: 3,
      },
      nit: {
        required: true,
        minlength: 3,
      },
      direccion: {
        required: true,
        minlength: 3,
      },
      nombre: {
        required: true,
        minlength: 3,
      },
      telefono: {
        required: true,
        minlength: 3,
      },
      email: {
        required: true,
        minlength: 3,
      },
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    }
  });
});
</script>