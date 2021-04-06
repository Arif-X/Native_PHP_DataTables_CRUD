  function load() {
    if (GBrowserIsCompatible()) {
      var lat = -8.0781;
      var longi = 112.6446;
      var map = new GMap2(document.getElementById("map"));
      map.addControl(new GSmallZoomControl3D());
      map.addControl(new GMenuMapTypeControl());
      var center = new GLatLng(lat,longi);
      map.setCenter(center, 9, G_PHYSICAL_MAP);
      map.setZoom(19); 
      geocoder = new GClientGeocoder();
      var marker = new GMarker(center, {draggable: true});  
      map.addOverlay(marker);
      map.addMapType(G_PHYSICAL_MAP);
      document.getElementById("lat").innerHTML = center.lat().toFixed(5);
      document.getElementById("lng").innerHTML = center.lng().toFixed(5);
      latt = document.getElementById("lat").innerHTML;
      document.getElementById("latt").value = center.lat().toFixed(5);
      longt = document.getElementById("lng").innerHTML;
      document.getElementById("longt").value = center.lng().toFixed(5);

      GEvent.addListener(marker, "dragend", function() {
       var point = marker.getPoint();
       map.panTo(point);
       document.getElementById("lat").innerHTML = point.lat().toFixed(5);
       document.getElementById("lng").innerHTML = point.lng().toFixed(5);
       latt = document.getElementById("lat").innerHTML;
       document.getElementById("latt").value = center.lat().toFixed(5);
       longt = document.getElementById("lng").innerHTML;
       document.getElementById("longt").value = center.lng().toFixed(5);

     });

      GEvent.addListener(map, "moveend", function() {
        map.clearOverlays();
        var center = map.getCenter();
        var marker = new GMarker(center, {draggable: true});
        map.addOverlay(marker);
        document.getElementById("lat").innerHTML = center.lat().toFixed(5);
        document.getElementById("lng").innerHTML = center.lng().toFixed(5);
        latt = document.getElementById("lat").innerHTML;
        document.getElementById("latt").value = center.lat().toFixed(5);
        longt = document.getElementById("lng").innerHTML;
        document.getElementById("longt").value = center.lng().toFixed(5);

        GEvent.addListener(marker, "dragend", function() {
          var point =marker.getPoint();
          map.panTo(point);
          document.getElementById("lat").innerHTML = point.lat().toFixed(5);
          document.getElementById("lng").innerHTML = point.lng().toFixed(5);
          latt = document.getElementById("lat").innerHTML;
          document.getElementById("latt").value = center.lat().toFixed(5);
          longt = document.getElementById("lng").innerHTML;
          document.getElementById("longt").value = center.lng().toFixed(5);
        });
      });
    }


    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    var table = $('.data-table').DataTable({
      processing: true,
      serverSide: true,    
      ajax: "{{ route('dhkp.index') }}",    
      scrollX: true,
      scrollY: "300px",
      fixedColumns: {
        leftColumns: 3
      },
      fixedHeader: true,
      columns: [
      {data: 'DT_RowIndex', name: 'DT_RowIndex'},
      {data: 'nama_wp', name: 'nama_wp'},
      {data: 'nop', name: 'nop'},
      {data: 'alamat', name: 'alamat'},
      {data: 'rt_rw', name: 'rt_rw'},
      {data: 'luas_tanah', name: 'luas_tanah'},
      {data: 'luas_bangunan', name: 'luas_bangunan'},
      {data: 'persil', name: 'persil'},
      {data: 'c', name: 'c'},      
      {data: 'alamat_wp', name: 'alamat_wp'},
      {data: 'rt_rw_wp', name: 'rt_rw_wp'},
      {data: 'kelurahan', name: 'kelurahan'},
      {data: 'kota', name: 'kota'},
      {data: 'pbb', name: 'pbb'},      
      {data: 'lokasi', name: 'lokasi', orderable: false, searchable: false},
      {data: 'action', name: 'action', orderable: false, searchable: false},
      ]
    });

    $('#createNewDHKP').click(function () {
      $('#saveBtn').val("create-dhkp");
      $('#dhkp_id').val('');
      $('#dhkpForm').trigger("reset");
      $('#modelHeading').html("Tambah DHKP");
      $('#ajaxModel').modal('show');
    });

    $('body').on('click', '.editDHKP', function () {
      var dhkp_id = $(this).data('id');
      $.get("{{ route('dhkp.index') }}" +'/' + dhkp_id +'/edit', function (data) {
        $('#modelHeading').html("Edit DHKP");
        $('#saveBtn').val("edit-user");
        $('#ajaxModel').modal('show');
        $('#dhkp_id').val(data.id);
        $('#nop').val(data.nop);
        $('#alamat').val(data.alamat);
        $('#rt_rw').val(data.rt_rw);
        $('#luas_tanah').val(data.luas_tanah);
        $('#luas_bangunan').val(data.luas_bangunan);
        $('#persil').val(data.persil);
        $('#c').val(data.c);
        $('#nama_wp').val(data.nama_wp);
        $('#alamat_wp').val(data.alamat_wp);
        $('#rt_rw_wp').val(data.rt_rw_wp);
        $('#kelurahan').val(data.kelurahan);
        $('#kota').val(data.kota);
        $('#pbb').val(data.pbb);
        $('#plat').val(data.lat);
        $('#plongi').val(data.longi);

        if (GBrowserIsCompatible()) {
          var lat = parseFloat(document.getElementById('plat').value);
          var longi = parseFloat(document.getElementById('plongi').value);
          var map = new GMap2(document.getElementById("map"));
          map.addControl(new GSmallZoomControl3D());
          map.addControl(new GMenuMapTypeControl());
          var center = new GLatLng(lat,longi);
          map.setCenter(center, 9, G_PHYSICAL_MAP);
          map.setZoom(19); 
          geocoder = new GClientGeocoder();
          var marker = new GMarker(center, {draggable: true});  
          map.addOverlay(marker);
          map.addMapType(G_PHYSICAL_MAP);
          document.getElementById("lat").innerHTML = center.lat().toFixed(5);
          document.getElementById("lng").innerHTML = center.lng().toFixed(5);
          latt = document.getElementById("lat").innerHTML;
          document.getElementById("latt").value = center.lat().toFixed(5);
          longt = document.getElementById("lng").innerHTML;
          document.getElementById("longt").value = center.lng().toFixed(5);


          GEvent.addListener(marker, "dragend", function() {
           var point = marker.getPoint();
           map.panTo(point);
           document.getElementById("lat").innerHTML = point.lat().toFixed(5);
           document.getElementById("lng").innerHTML = point.lng().toFixed(5);
           latt = document.getElementById("lat").innerHTML;
           document.getElementById("latt").value = center.lat().toFixed(5);
           longt = document.getElementById("lng").innerHTML;
           document.getElementById("longt").value = center.lng().toFixed(5);

         });

          GEvent.addListener(map, "moveend", function() {
            map.clearOverlays();
            var center = map.getCenter();
            var marker = new GMarker(center, {draggable: true});
            map.addOverlay(marker);
            document.getElementById("lat").innerHTML = center.lat().toFixed(5);
            document.getElementById("lng").innerHTML = center.lng().toFixed(5);
            latt = document.getElementById("lat").innerHTML;
            document.getElementById("latt").value = center.lat().toFixed(5);
            longt = document.getElementById("lng").innerHTML;
            document.getElementById("longt").value = center.lng().toFixed(5);

            GEvent.addListener(marker, "dragend", function() {
              var point =marker.getPoint();
              map.panTo(point);
              document.getElementById("lat").innerHTML = point.lat().toFixed(5);
              document.getElementById("lng").innerHTML = point.lng().toFixed(5);
              latt = document.getElementById("lat").innerHTML;
              document.getElementById("latt").value = center.lat().toFixed(5);
              longt = document.getElementById("lng").innerHTML;
              document.getElementById("longt").value = center.lng().toFixed(5);
            });
          });
        }
      })
    });

    $('#saveBtn').click(function (e) {
      e.preventDefault();
      $(this).html('Memproses..');

      $.ajax({
        data: $('#dhkpForm').serialize(),
        url: "{{ route('dhkp.store') }}",
        type: "POST",
        dataType: 'json',
        success: function (data) {
          $('#dhkpForm').trigger("reset");
          $('#saveBtn').html('Simpan');
          $('#ajaxModel').modal('hide');
          table.draw();

        },
        error: function (data) {
          console.log('Error:', data);
          $('#saveBtn').html('Simpan');
        }
      });
    });

    $('body').on('click', '.deleteDHKP', function () {
      var dhkp_id = $(this).data("id");
      confirm("Are You sure want to delete !");

      $.ajax({
        type: "DELETE",
        url: "{{ route('dhkp.store') }}"+'/'+dhkp_id,
        success: function (data) {
          table.draw();
        },
        error: function (data) {
          console.log('Error:', data);
        }
      });
    });
  };