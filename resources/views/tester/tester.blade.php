<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>coba dengan ajax</title>
  </head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <body>
  <div id="info">
  </div>
  <label>Pilih Kelas </label>
    <select class="kelas" name="kelas" id="kelas">
      <option value="0" disabled="true" selected="true">-Select-</option>
      @foreach ($kelas as $value)
      <option value="{{$value->id}}">{{ $value->nm_kelas }}</option>
      @endforeach
    </select>

    <span>Product Name: </span>
    <select style="width: 200px" class="productname">
        <option value="0" disabled="true" selected="true">Pilih Kelas</option>
    </select>


    <script type="text/javascript">

      $(document).ready(function(){
        $(document).on('change','.kelas', function(){
          //console.log('berubah');
          var id_kel=$(this).val();
		  //console.log(id_kel);
		  var div=$(this).parent();
		   var op=" ";
          $.ajax({
			  type:'get',
			  url:'{!!URL::to('carisiswa')!!}',
			  data:{'id':id_kel},
			  success:function(data)
			  {
				  console.log(data);
				  //console.log(data.length);
				  op+='<option value="0" selected disabled>Cari Siswa</option>';
                    for(var i=0;i<data.length;i++)
					{
                    op+='<option value="'+data[i].nama+'">'+data[i].nama+'</option>';
					}
				div.find('.productname').html(" ");
				div.find('.productname').append(op);
			  }
		  });
        });
      });
    </script>


  </body>
</html>
