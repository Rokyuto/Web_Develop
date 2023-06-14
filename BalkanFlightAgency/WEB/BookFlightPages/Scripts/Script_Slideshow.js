const images = [
	'url("./Images/BALKAN-Bulgarian-Airlines-1.png")',
	'url("./Images/BALKAN-Bulgarian-Airlines-2.png")',
	'url("./Images/BALKAN-Bulgarian-Airlines-3.png")',
	'url("./Images/BALKAN-Bulgarian-Airlines-4.png")'
]

function RandomBgdImage(){
	const body = document.querySelector('body');
	const bgd = images[Math.floor(Math.random() * images.length)];

	body.style.backgroundImage = bgd;
}
setInterval(RandomBgdImage,5000);