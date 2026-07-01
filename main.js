
const {app, BrowserWindow } = require("electron");

function createWindow (){
const win= new BrowserWindow({
height :800,
width :1000
});
//win.loadFile('index.php')
win.loadURL('http://localhost/Proyecto_Hospital/');
}       
app.whenReady().then (createWindow);

