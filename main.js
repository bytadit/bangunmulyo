const { app, BrowserWindow } = require('electron');
const path = require('path');
const { spawn } = require('child_process');

let phpServer;

function startPhpServer() {
    // Specify the full path to php.exe in your Laravel root folder
    const phpPath = 'C:/xampp/php/php.exe';
    // Path to your Laravel's public directory
    const serverPath = 'public';
    phpServer = spawn(phpPath, ['-S', '127.0.0.1:8000', '-t', serverPath]);

    phpServer.stdout.on('data', (data) => {
        console.log(`PHP Server stdout: ${data}`);
    });

    phpServer.stderr.on('data', (data) => {
        console.error(`PHP Server: ${data}`);
    });

    phpServer.on('close', (code) => {
        console.log(`PHP Server process exited with code ${code}`);
    });
}

function createWindow() {
    let loadingWin = new BrowserWindow({
        width: 600,
        height: 600,
        frame: false, // Optional: Remove window frame for splash screen
        webPreferences: {
            nodeIntegration: true
        }
    });
    loadingWin.maximize();

    // Load the loading.html page initially
    loadingWin.loadFile('loading.html');

    // Create the main window but don't show it yet
    let mainWin = new BrowserWindow({
        width: 1366,
        height: 768,
        show: false, // Initially hide the main window
        webPreferences: {
            nodeIntegration: true
        }
    });

    // Load the main content page
    mainWin.loadURL('http://127.0.0.1:8000');

    // Show the main window when it's ready
    mainWin.once('ready-to-show', () => {
        loadingWin.destroy(); // Close the loading window
        mainWin.show(); // Show the main window
    });

    mainWin.on('closed', () => {
        mainWin = null;
    });
}

app.commandLine.appendSwitch('ignore-certificate-errors');
app.on('ready', () => {
    startPhpServer();
    createWindow();
});

app.on('window-all-closed', () => {
    if (process.platform !== 'darwin') {
        app.quit();
    }
});

app.on('activate', () => {
    if (BrowserWindow.getAllWindows().length === 0) {
        createWindow();
    }
});

app.on('before-quit', () => {
    if (phpServer) {
        phpServer.kill();
    }
});
