function RandomBg(){
	const images = [
		'url("My_Images/Rose.jpg")',
		'url("My_Images/Yuna.jpg")',
		'url("My_Images/Hunter_X_Hunter_Wallpaper.png")',
		'url("My_Images/Glass_Planet.png")',
		'url("My_Images/Tokyo.jpg")',
		'url("My_Images/anime.jpg")',
		'url("My_Images/MSI.jpg")'
	]

	const container = document.getElementById('bg');
	const bg = images[Math.floor(Math.random() * images.length)];

	container.style.backgroundImage = bg;
}
setInterval(RandomBg,5000);