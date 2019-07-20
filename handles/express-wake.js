app.post('/wake', (req, res) => {
    if (!req.body || !req.body.identifier) {
        res.send('ERROR_BAD_PARAMS');
    } else {
        res.send(req.body.identifier.toString());
    }
});