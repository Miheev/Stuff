function changeImage(src, desc) {
	if (document.getElementById('maki_house_big_image_id')) {
		document.getElementById('maki_house_big_image_id').src = src;
		document.getElementById('maki_house_big_image_id').alt = desc;
		document.getElementById('maki_house_big_image_id').title = desc;
	}
}