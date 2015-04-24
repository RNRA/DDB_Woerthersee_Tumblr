function loadStage(language) {
	jQuery.ajax("http://localhost/gtibackend/stage", {
		type: "GET",
		data: {
			"language": language
		},
		success: function(data) {
			StageLoader.work(data);
		}
	});
}