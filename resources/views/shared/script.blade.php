<!-- Libs JS -->
<script src="{{ asset('assets/dist/libs/apexcharts/dist/apexcharts.min.js?1684106062') }}" defer></script>
<script src="{{ asset('assets/dist/libs/jsvectormap/dist/js/jsvectormap.min.js?1684106062') }}" defer></script>
<script src="{{ asset('assets/dist/libs/jsvectormap/dist/maps/world.js?1684106062') }}" defer></script>
<script src="{{ asset('assets/dist/libs/jsvectormap/dist/maps/world-merc.js?1684106062') }}" defer></script>
<!-- Tabler Core -->
<script src="{{ asset('assets/dist/js/tabler.min.js?1684106062') }}" defer></script>
<script src="{{ asset('assets/dist/js/demo.min.js?1684106062') }}" defer></script>
<script src="{{ asset('assets/dist/libs/litepicker/dist/litepicker.js') }}" defer></script>
<script src="{{ asset('assets/dist/libs/fslightbox/index.js?1684106062') }}" defer></script>

<script src="{{ asset('assets/extentions/jquery-3.7.1.min.js') }}"></script>
<script src="{{ asset('assets/extentions/jquery.validate.min.js') }}"></script>

<link href="{{ asset('assets/extentions/xeditable/jquery-editable.css') }}" rel="stylesheet" />
{{-- <script src="{{ asset('assets/extentions/xeditable/jquery-editable-poshytip.min.js') }}"></script> --}}

<!-- Datatables -->
<script src="{{ asset('assets/extentions/datatables/datatables.min.js') }}"></script>
<link href="{{ asset('assets/extentions/datatables/DataTables-1.13.4/css/dataTables.bootstrap5.css') }}"
    rel="stylesheet">
<link href="{{ asset('assets/extentions/datatables/Buttons-2.3.4/css/buttons.bootstrap5.min.css') }}" rel="stylesheet">
<script src="{{ asset('assets/extentions/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/extentions/datatables/DataTables-1.13.4/js/dataTables.bootstrap5.js') }}"></script>
<script src="{{ asset('assets/extentions/datatables/Buttons-2.3.4/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/extentions/datatables/Buttons-2.3.4/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/extentions/datatables/Buttons-2.3.4/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets/extentions/datatables/Buttons-2.3.4/js/buttons.colVis.min.js') }}"></script>
<script src="{{ asset('assets/extentions/datatables/Buttons-2.3.4/js/buttons.bootstrap5.min.js') }}"></script>
<link type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css"
    rel="stylesheet">
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script type="text/javascript" src="http://keith-wood.name/js/jquery.signature.js"></script>
<link rel="stylesheet" type="text/css" href="http://keith-wood.name/css/jquery.signature.css">

<script src="{{ asset('assets/extentions/datatables/Select-1.6.0/js/dataTables.select.min.js') }}"></script>
<script src="{{ asset('assets/extentions/datatables/Select-1.6.0/js/select.dataTables.min.js') }}"></script>

<script src="{{ asset('assets/extentions/select2/js/select2.full.min.js') }}" defer></script>
<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
<script src="{{ asset('assets/extentions/richtext/jquery.richtext.min.js') }}"></script>
<script src="{{ asset('assets/extentions/jquery.mask.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/libs/tinymce/tinymce.min.js" defer></script>
<script>
    $(document).ready(function() {
        $(".searchengine").select2({
            language: "id",
            allowClear: true,
            // width: '700px',
            minimumInputLength: 3,
            placeholder: "Pencarian Barang.",
            ajax: {
                url: "/getSearchEngine",
                dataType: 'json',
                delay: 200,
                processResults: function(response) {
                    console.log(response);
                    return {
                        results: $.map(response, function(item) {
                            return {
                                id: item.kodeseri,
                                text: item.kodeseri +
                                    " - " + item.namaBarang.toUpperCase() +
                                    " " + (item.keterangan == null ? "" : item.keterangan
                                        .toUpperCase()) +
                                    " " + (item.katalog == null ? "" : item.katalog
                                        .toUpperCase()) +
                                    " " + (item.part == null ? "" : item.part
                                        .toUpperCase()),
                            }
                        })
                    };
                },
                cache: true
            },
        });
    });
    $(document.body).on("change click blur select", ".searchengine", function() {
        // console.log(this.value);

        var kodeseri = this.value;
        console.log("Mencari: " + this.value);
        // $("#modal_body1").html(this.value);
        $("#overlaySearch").fadeIn(300);
        $('#modalSearchEngine').modal('show');
        $.ajax({
            type: 'POST',
            url: '/searchEngineModal',
            data: {
                "_token": "{{ csrf_token() }}",
                kodeseri: kodeseri
            },
            success: function(data) {
                $('.fetched-data-search').html(data); //menampilkan data ke dalam modal
            }
        }).done(function() {
            setTimeout(function() {
                $("#overlaySearch").fadeOut(300);
                $('.searchengine').html('');
            }, 500);
        });
    });
</script>

<!-- Start Modal Detail -->
<div class="modal fade" id="modalSearchEngine" role="dialog">
    <style>
        #overlaySearch {
            position: fixed;
            top: 0;
            z-index: 100;
            width: 100%;
            height: 100%;
            display: none;
            background: rgba(0, 0, 0, 0.6);
        }

        .cv-spinnerSearch {
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .spinnerSearch {
            width: 40px;
            height: 40px;
            border: 4px #ddd solid;
            border-top: 4px #2e93e6 solid;
            border-radius: 50%;
            animation: sp-anime 0.8s infinite linear;
        }

        @keyframes sp-anime {
            100% {
                transform: rotate(360deg);
            }
        }

        .is-hide {
            display: none;
        }

        .modal-full {
            min-width: 100%;
            margin: 10 10 10 10;
        }

        .modal-full .modal-content {
            min-height: 100%;
        }
    </style>
    <div id="overlaySearch">
        <div class="cv-spinnerSearch">
            <span class="spinnerSearch"></span>
        </div>
    </div>
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="fa-solid fa-circle-info"></i> Pencarian Barang</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body py-0 px-0">
                <div class="fetched-data-search"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Keluar</button>
            </div>
        </div>
    </div>
</div>
<!-- End Modal Detail -->
