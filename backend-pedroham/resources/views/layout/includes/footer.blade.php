<!-- Footer -->
<footer class="page-footer font-small blue pt-4 bg-dark">

    <!-- Footer Links -->
    <div class="container-fluid text-center text-md-left">
  
      <!-- Grid row -->
      <div class="row">
  
      </div>
      <!-- Grid row -->
  
    </div>

    <div class="footer-copyright text-center py-3">
    </div>
  </footer>
</body>

<script>
  var active = localStorage.getItem("active_menu");
  {
    if(active == '' || location.href == location.origin + '/admin')
      active = 'dash'
    $('#' + active).addClass('active')
    if($('#' + active).parent().parent().parent().hasClass('has-treeview'))
      $('#' + active).parent().parent().parent().addClass('menu-open')
  }
  
  $('.nav-link').on('click', function(e){
    localStorage.setItem("active_menu", $(this).attr('id'));    
  })

  @if(Session::has('message'))
    var type = "{{Session::get('alert-type') }}"

    var deleted = "{{Session::get('deleted') }}"

    $(document).ready(function () {
      if(deleted){
        if(type !== 'error'){//variavel que contem o tipo do alerta
              Swal.fire(
                  'Deletado!',
                  'Registro Deletado!',
                  'success'
                )
          }
          else{
              Swal.fire(
                  'Ops!',
                  'Por algum motivo nao pudemos concluir o procedimento!',
                  'error'
                )
          }
      }
      else{        
        switch (type) {
            case 'success':
                toastr.success("{{ Session::get('message') }}", 'Sucesso', {
                    timeOut: 5000,
                    "closeButton": true,
                    "debug": false,
                    "newestOnTop": true,
                    "progressBar": true,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": true,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut",
                    "tapToDismiss": false
                })
                break;
            case 'error':
                toastr.error("{{ Session::get('message') }}", 'Erro', {
                    timeOut: 5000,
                    "closeButton": true,
                    "debug": false,
                    "newestOnTop": true,
                    "progressBar": true,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": true,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut",
                    "tapToDismiss": false
                })
            break;
        }
      }        
    });
    @endif
</script>
</html>