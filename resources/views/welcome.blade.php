<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ env('APP_NAME') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"/>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.23/dist/sweetalert2.min.css"/>

        <!-- Styles -->
        <style>
            *,body{font-family:Poppins,sans-serif;font-weight:400;-webkit-font-smoothing:antialiased;text-rendering:optimizeLegibility;-moz-osx-font-smoothing:grayscale}body,html{height:100%;background-color:#152733;overflow:hidden}.form-holder{display:flex;flex-direction:column;justify-content:center;align-items:center;text-align:center;min-height:100vh}.form-holder .form-content{position:relative;text-align:center;display:-webkit-box;display:-moz-box;display:-ms-flexbox;display:-webkit-flex;display:flex;-webkit-justify-content:center;justify-content:center;-webkit-align-items:center;align-items:center;padding:60px}.form-content .form-items{border:3px solid #fff;padding:40px;display:inline-block;width:100%;min-width:540px;-webkit-border-radius:10px;-moz-border-radius:10px;border-radius:10px;text-align:left;-webkit-transition:.4s;transition:.4s}.form-content h3{color:#fff;text-align:left;font-size:28px;font-weight:600;margin-bottom:5px}.form-content h3.form-title,.form-content p{margin-bottom:30px}.form-content p{color:#fff;text-align:left;font-size:17px;font-weight:300;line-height:20px}.form-content label,.was-validated .form-check-input:invalid~.form-check-label,.was-validated .form-check-input:valid~.form-check-label{color:#fff}.form-content input[type=email],.form-content input[type=password],.form-content input[type=text],.form-content select{width:100%;padding:9px 20px;text-align:left;border:0;outline:0;border-radius:6px;background-color:#fff;font-size:15px;font-weight:300;color:#8d8d8d;-webkit-transition:.3s;transition:.3s;margin-top:16px}.btn-primary{background-color:#6c757d;outline:0;border:0;box-shadow:none}.btn-primary:active,.btn-primary:focus,.btn-primary:hover{background-color:#495056;outline:0!important;border:none!important;box-shadow:none}.form-content textarea{position:static!important;width:100%;padding:8px 20px;border-radius:6px;text-align:left;background-color:#fff;border:0;font-size:15px;font-weight:300;color:#8d8d8d;outline:0;resize:none;height:120px;-webkit-transition:none;transition:none;margin-bottom:14px}.form-content textarea:focus,.form-content textarea:hover{border:0;background-color:#ebeff8;color:#8d8d8d}.mv-up{margin-top:-9px!important;margin-bottom:8px!important}.invalid-feedback{color:#ff606e}.valid-feedback{color:#2acc80}
        </style>
    </head>
    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">

            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
                <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
                    <div class="form-body">
                        <div class="row">
                            <div class="form-holder">
                                <div class="form-content">
                                    <div class="form-items">
                                        <h3>OTO Servis Kayıt</h3>
                                        <form id="repairForm">
                                            @csrf
                                            <div class="col-md-12">
                                               <input class="form-control" type="text" name="name" placeholder="Adınız Soyadınız" required>
                                            </div>
                                            <div class="col-md-12">
                                                <select class="form-select mt-3" id="brands" required>
                                                      <option value="">Marka</option>
                                                      @foreach ($brands as $item)
                                                          <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                      @endforeach
                                               </select>
                                            </div>
                                            <div class="col-md-12">
                                               <div id="models"></div>
                                            </div>
                                            <div class="col-md-12">
                                                <select class="form-select mt-3" id="repair_types" required>
                                                      <option value="">Tamir Türü</option>
                                                      @foreach ($types as $item)
                                                          <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                      @endforeach
                                               </select>
                                            </div>
                                            <div class="col-md-12">
                                               <div id="addresses"></div>
                                            </div>
                                            <div class="col-md-12">
                                                <input class="form-control datepicker" type="text" name="date" placeholder="Tarih Seçiniz">
                                            </div>
                                            <div class="row g-3">
                                                <div class="col-md-6">
                                                    <select name="hour" class="form-control">
                                                        <option value="">Saat</option>
                                                        <option value="09">00</option>
                                                        <option value="10">10</option>
                                                        <option value="11">11</option>
                                                        <option value="12">12</option>
                                                        <option value="13">13</option>
                                                        <option value="14">14</option>
                                                        <option value="15">15</option>
                                                        <option value="16">16</option>
                                                        <option value="17">17</option>
                                                        <option value="18">18</option>
                                                        <option value="19">19</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <select name="minute" class="form-control">
                                                        <option value="">Dakika</option>
                                                        <option value="00">00</option>
                                                        <option value="30">30</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-button mt-3">
                                                <button id="submit" type="submit" class="btn btn-primary submit-customer-button">Onayla</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                
                </div>
            </div>
        </div>
    </body>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.23/dist/sweetalert2.all.min.js"></script>
    
    <script>
        // serializeObject Fonksiyonu
        $.fn.serializeObject = function(){
            var o = {};
            var a = this.serializeArray();
            $.each(a, function() {
                if (o[this.name]) {
                    if (!o[this.name].push) {
                        o[this.name] = [o[this.name]];
                    }
                    o[this.name].push(this.value || '');
                } else {
                    o[this.name] = this.value || '';
                }
            });
            return o;
        };
        $( document ).ready(function() {

            $('.datepicker').datepicker({
                format: 'dd/mm/yyyy',
                language: "tr",
                autoclose: true,
            }).on('changeDate', function(e) {
                $.ajax({
                    type: 'GET',
                    url: "{{ route( 'checkDate' ) }}",
                    data: {
                        date : $('.datepicker').val(),
                        address : $('#repair_address').val()
                    },
                    dataType:'JSON',
                    success: function(response){
                        console.log(response);
                        if (response.success == false) {
                            Swal.fire("Hata", response.message, "error");
                            $('.submit-customer-button').prop('disabled', true);
                        } else {
                            $('.submit-customer-button').prop('disabled', false);
                        }
                    }
                });
            });

            $('#brands').change(function(){
                var id = $(this).val();
                $.ajax({
                    url : "{{ route( 'loadModels' ) }}",
                    data: {
                        id:id
                    },
                    type: 'get',
                    success: function( result )
                    {
                        document.getElementById('models').innerHTML = result;
                    }
                });
            });

            $('#repair_types').change(function(){
                var id = $(this).val();
                $.ajax({
                    url : "{{ route( 'loadAddresses' ) }}",
                    data: {
                        id:id
                    },
                    type: 'get',
                    success: function( result )
                    {
                        document.getElementById('addresses').innerHTML = result;
                    }
                });
            });

            $('.submit-customer-button').on('click', function(event) {
                event.preventDefault();
                let formData = $('#repairForm').serializeObject();
                $.ajax({
                    type: "post",
                    url: "{{ route('repairCreate') }}",
                    data: formData,
                    dataType:'JSON',
                    success: function (response) {
                        if (response.success) {
                            Swal.fire("Başarılı", response.message, "success");
                        } else {
                            Swal.fire("Hata", response.message, "error");
                        }
                        setTimeout(function () {
                            location.reload(true);
                        }, 3000);
                    }
                });
            });
        });
    </script>
</html>
