var nodemailer = require('nodemailer');

var transporter = nodemailer.createTransport({
  service: 'gmail',
  auth: {
    user: 'shashankgoud001@gmail.com',
    pass: '9866304204'
  }
});

var mailOptions = {
  from: 'shashankgoud001@gmail.com',
  to: 'spartanspirals@gmail.com',
  subject: 'Sending Email using Node.js',
  text: 'That was easy!'
};

transporter.sendMail(mailOptions, function(error, info){
  if (error) {
    console.log(error);
  } else {
    console.log('Email sent: ' + info.response);
  }
});