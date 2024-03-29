<!DOCTYPE html>
<html>
    <head>
        <title>HALAMAN UTAMA GIS BENCANA DI PROBOLINGGO</title>

        <meta charset="UTF-8">
        <meta name="description" content="Clean and responsive administration panel">
        <meta name="keywords" content="Admin,Panel,HTML,CSS,XML,JavaScript">
        <meta name="author" content="Erik Campobadal">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="<?=base_url('public/')?>images/logo.png">

        <link rel="stylesheet" href="<?=base_url('public/')?>css/uikit.min.css" />
		<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
		<link rel="stylesheet" href="<?=base_url('public/')?>css/style.css" />
        <link rel="stylesheet" href="<?=base_url('public/')?>css/notyf.min.css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script> 
        <script src="<?=base_url('public/')?>js/uikit.min.js" ></script>
		<script src="<?=base_url('public/')?>js/uikit-icons.min.js" ></script>
        <!-- leaflet koneksi -->
        <link rel="stylesheet" href="<?=base_url('public/')?>leaflet/leaflet.css" />
        <script src="<?=base_url('public/')?>leaflet/leaflet.js" ></script>
        <!-- leaflet koneksi -->
        <!-- Pencarian GIS -->

        <link rel="stylesheet" href="<?=base_url('public/')?>leaflet-cari/src/leaflet-search.css"/>
        <script src="<?=base_url('public/')?>leaflet-cari/src/leaflet-search.js" ></script>
        <!-- Pencarian GIS -->

        <style typle="text/css">
		#mapid { height: 700px; }
	</style>
    </head>
    <body>
        <div  class="uk-navbar-container tm-navbar-container uk-active">
            <div class="uk-container uk-container-expand">
                <nav uk-navbar>
                    <div class="uk-navbar-left">
                        <a href="#" class="uk-navbar-item uk-logo">
                            <img width="40" src="<?=base_url('public/')?>images/logo.png" /> &nbsp; TITIK RAWAN BENCANA DI KAB. PROBOLINGGO
                        </a>
                    </div>
                    <div class="uk-navbar-right">

                    <div class="uk-navbar-item">
            <form action="javascript:void(0)">
               
                <a class="uk-button uk-button-default" href="#modal-center" uk-toggle>BIODATA</a>
            </form>
        </div>
        

    </div>
                </nav>
            </div>
        </div>
        <div class="uk-container uk-container-large">
        <article class="uk-comment uk-comment-primary">
        <div id="mapid"></div>
        </article>

        <script type="text/javascript">
        	var data = [
                <?php 
                foreach ($bencana as $key => $r) { ?>
		            {"lokasi":[<?= $r->latitudeBencana ?>, <?=$r->longitudeBencana?>], 
                    "kecamatan":"<?=$r->kecamatanBencana?>", 
                    "keterangan":"<?=$r->keteranganBencana?>", 
                    "tempat":"<?=$r->lokasiBencana?>",
                    "kategori":"<?=$r->kategoriBencana?>"
                    },
                <?php } ?>
	        ];
	
        var map = new L.Map('mapid', {zoom: 10, center: new L.latLng(-7.8518553,113.0054501) });
		map.addLayer(new L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
				attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
                        '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
                        'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                        id: 'mapbox/streets-v11'}));

    var markersLayer = new L.LayerGroup();	
	map.addLayer(markersLayer);

	var controlSearch = new L.Control.Search({
		position:'topleft',		
		layer: markersLayer,
		initial: false,
		zoom: 25,
		marker: false
	});

	map.addControl( new L.Control.Search({
		
		layer: markersLayer,
		initial: false,
		collapsed: true,
	}) );

    var angin = L.icon({
            iconUrl: '<?=base_url('public/icon/angin.png')?>',
            iconSize:[30,30]
    });

    var banjir = L.icon({
            iconUrl: '<?=base_url('public/icon/banjir.png')?>',
            iconSize:[30,30]
    });

    var gempabumi = L.icon({
            iconUrl: '<?=base_url('public/icon/gempabumi.png')?>',
            iconSize:[30,30]
    });
    
    var kebakaran = L.icon({
            iconUrl: '<?=base_url('public/icon/kebakaran.png')?>',
            iconSize:[30,30]
    });

    var kecelakaan = L.icon({
            iconUrl: '<?=base_url('public/icon/kecelakaan.png')?>',
            iconSize:[30,30]
    });

    var longsor = L.icon({
            iconUrl: '<?=base_url('public/icon/longsor.png')?>',
            iconSize:[30,30]
    });

    var pohontumbang = L.icon({
            iconUrl: '<?=base_url('public/icon/pohontumbang.png')?>',
            iconSize:[30,30]
    });

    var tsunami = L.icon({
            iconUrl: '<?=base_url('public/icon/tsunami.png')?>',
            iconSize:[30,30]
    });

    var icons ="";
    for(i in data) {
		var kecamatan = data[i].kecamatan;
		var	lokasi = data[i].lokasi;
		var	tempat = data[i].tempat;
		var	keterangan = data[i].keterangan;
		var	kategori = data[i].kategori;

        if (kategori=="banjir") {
            icons=banjir;
        }else if (kategori=="angin"){
            icons=angin;
        }else if (kategori=="tsunami"){
            icons=tsunami;
        
        }else if (kategori=="gempabumi"){
            icons=gempabumi;

        }else if (kategori=="kebakaran"){
            icons=kebakaran;

        }else if (kategori=="kecelakaan"){
            icons=kecelakaan;
        }
        else if (kategori=="longsor"){
            icons=longsor;
        }
        else if (kategori=="pohontumbang"){
            icons=pohontumbang;
        }

		var marker = new L.Marker(new L.latLng(lokasi), {title: kecamatan,icon:icons});
		marker.bindPopup('<b>Kecamatan: '+ kecamatan +' <br> Lokasi: ' + tempat + '<br> Keterangan: '+ keterangan +'</b>'  );
		markersLayer.addLayer(marker);
	}

			
		</script>
        </div>
       
    </body>
</html>

<!-- MODAl -->
<div id="modal-center" class="uk-flex-top" uk-modal>
    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">

        <button class="uk-modal-close-default" type="button" uk-close></button>

        <div class="uk-container uk-container-large">
        <article class="uk-comment uk-comment-primary">
    <header class="uk-comment-header">
        <div class="uk-grid-medium uk-flex-middle" uk-grid>
            <div class="uk-width-auto">
                <img class="uk-comment-avatar" src="<?=base_url('public/')?>images/logo.png" width="80" height="80" alt="">
            </div>
            <div class="uk-width-expand">
                <h4 class="uk-comment-title uk-margin-remove"><a class="uk-link-reset" href="#">Master AI</a></h4>
                <h4 class="uk-comment-title uk-margin-remove"><a class="uk-link-reset" href="#">Penelitian,Pengabdian dan Pengajaran</a></h4>
                
            </div>
        </div>
    </header>
    <div class="uk-comment-body">
        <b> <center>Aplikasi Tentang Lokasi Bencana</center> </b>
    </div>
</article>


        </div>

    </div>
</div>
<!-- MODAl -->
