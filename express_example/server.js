const express = require('express');
const axios = require('axios');
const bodyParser = require('body-parser');
const app = express();
app.use(bodyParser.urlencoded({extended:true}));
app.use(bodyParser.json());

app.post('/echo', (req,res)=> {
  res.json({received: req.body});
});

// Example: call PHP REST API
app.get('/php-products', async (req,res)=>{
  try{
    const r = await axios.get('http://localhost/path_to_project/api/products_api.php'); // adjust URL
    res.json(r.data);
  }catch(e){
    res.status(500).send('Error: '+e.message);
  }
});

app.listen(3000, ()=> console.log('Express running on 3000'));
