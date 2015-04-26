function loadStage(language) {
	jQuery.ajax("http://localhost/DDB_Woerthersee_Tumblr/", {
		type: "GET",
		data: {
			"language": language
		},
		success: function(data) {
			StageLoader.work(data);
		}
	});
}