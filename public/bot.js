const { Client, LocalAuth } = require('whatsapp-web.js');
const qrcode = require('qrcode-terminal');
const express = require('express');
const app = express();
const port = 3000;

const client = new Client({
    authStrategy: new LocalAuth(),
    puppeteer: { headless: true }
});

client.on('qr', (qr) => {
    qrcode.generate(qr, { small: true });
});

client.on('ready', () => {
    console.log('Client is ready!');
});

client.initialize();

app.post('/send-message', async (req, res) => {
    const number = req.query.number;
    const message = req.query.message;

    client.sendMessage(`${number}@c.us`, message).then(response => {
        res.status(200).json({
            status: true,
            response: response
        });
    	console.log(`terkirim`);
    }).catch(err => {
        res.status(500).json({
            status: false,
            response: err
        });
    });
});

app.listen(port, () => {
    console.log(`App running on http://localhost:${port}`);
});
