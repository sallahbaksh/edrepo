function iFrameOn()
{
	richTextArea.document.designMode = "On"; 
}
function Bold()
{
	richTextArea.document.execCommand('bold', false, null); 
}
function Italics()
{
	richTextArea.document.execCommand('italic', false, null); 
}
function Underline()
{
	richTextArea.document.execCommand('underline', false, null); 
}
function Size()
{ 
	var size = document.getElementById("size").value;
	richTextArea.document.execCommand('FontSize', false, size); 
}
function Color()
{
	var textColor = document.getElementById("color").style.backgroundColor;
	var hexTextColor = toHexi(textColor); 
	richTextArea.document.execCommand('ForeColor', false, hexTextColor); 
}
function toHexi(colors)
{
	if (colors != colors.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/)){
		colors = colors.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);
		for (var i = 1; i <= 3; i++){
			var rgb = colors[i]; 
			var solve = ("0" + parseInt(rgb).toString(16)).slice(-2);
			var stuff = (stuff + solve).slice(-6); 
		}
		return "#" + stuff; 
	}
	else 
		return colors; 
}
function Link()
{
	var linkURL = prompt("Enter the URL you wish to link the text to:", "http://"); 
	richTextArea.document.execCommand('CreateLink', false, linkURL); 
}
function Unlink()
{
	richTextArea.document.execCommand('Unlink', false, null); 
}
function submitForm()
{
	var form = document.getElementById("myform"); 
	form.elements["textArea"].value = windows.frames['richTextArea'].document.body.innerHTML; 
	form.submit(); 
}