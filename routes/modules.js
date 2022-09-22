const router = require('express').Router();
const { spawn } = require('child_process');


router.post('/modules', (req, res) => {
    const body = req.body;
    const child = spawn([`${body.command}`]);

    child.stdout.on('data', (data) => {
        return res.status(200).json({
            success: 0,
            message: "Stdout",
            data: data.toString()
        });
    })

    child.stderr.on('data', (data) => {
        return res.status(200).json({
            success: 1,
            message: "Stderr",
            data: data.toString()
        });
    });
    child.on('error', (error) => {
        return res.status(500).json({
            success: 0,
            message: "Error",
            error: error.toString()
        });
    });
    child.on('exit', (code, signal) => {
        if (code) {
            console.log(`child process exited with code ${code}`);
        }
        if (signal) {
            console.log(`child process exited with signal ${signal}`);
        }
    });

});
module.exports = router;