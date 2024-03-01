const { app, BrowserWindow } = require('electron');
const { spawn } = require('child_process');

let laravelServer;

function startLaravelServer() {
    laravelServer = spawn('php', ['artisan', 'serve']);

    laravelServer.stdout.on('data', (data) => {
        console.log(`Server stdout: ${data}`);
    });

    laravelServer.stderr.on('data', (data) => {
        console.error(`Server stderr: ${data}`);
    });

    laravelServer.on('close', (code) => {
        console.log(`Server process exited with code ${code}`);
    });
}

function createWindow() {
    const win = new BrowserWindow({
        width: 800,
        height: 600,
        webPreferences: {
            nodeIntegration: true
        }
    });

    win.loadURL('http://localhost:8000');

    win.webContents.openDevTools();

    win.on('closed', () => {
        win = null;
    });
}

app.whenReady().then(() => {
    // Start the Laravel server
    startLaravelServer();

    // Create Electron window
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

// Catch termination signal to stop Laravel server
app.on('before-quit', () => {
    if (laravelServer) {
        laravelServer.kill('SIGINT');
    }
});
