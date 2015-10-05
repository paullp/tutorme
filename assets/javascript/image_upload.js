function readURL(input) {
        $('#message').show();
		if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#image')
                    .attr('src', e.target.result)
                    .width(144)
                    .height(144);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
	
