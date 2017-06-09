var http = require('http')
var express = require('express')
var router = express.Router()
var path = require('path')
var favicon = require('serve-favicon')
var logger = require('morgan')
var methodOverride = require('method-override')
var bodyParser = require('body-parser')
var cookieParser = require('cookie-parser')
var csrf = require('csurf')
var errorHandler = require('errorhandler')
var session = require('express-session')
var mongoskin = require('mongoskin')
var db = mongoskin.db('mongodb://admin:jack@ds111622.mlab.com:11622/lista-del-super', {safe:true})

// Routes
var routes = require('./routes')
var tasks = require('./routes/tasks')

var app = express()

app.use(function(req,res,next) {
  req.db = {}
  req.db.tasks = db.collection('tasks')
  next()
})

// all environments
app.locals.appname = 'Lista de Supermercado'
app.locals.moment = require('moment')

app.set('port', process.env.PORT || 3000)
app.set('views', path.join(__dirname, 'views'))
app.set('view engine', 'pug')
//app.use(favicon(path.join('public','favicon.ico')));
app.use(logger('dev'))
app.use(bodyParser.json())
app.use(bodyParser.urlencoded({extended: true}))
app.use(methodOverride())
app.use(cookieParser('98DAF1999EA31E7A7B8E78E269EFE'))
app.use(session({
  secret: '98DAF1999EA31E7A7B8E78E269EFE',
  resave: true,
  saveUninitialized: true
}))
app.use(csrf())

app.use(require('less-middleware')(path.join(__dirname, 'public')))
app.use(express.static(path.join(__dirname, 'public')))
app.use(function(req, res, next) {
  res.locals._csrf = req.csrfToken()
  return next()
})

app.param('task_id', function(req, res, next, taskId) {
  req.db.tasks.findById(taskId, function(error, task){
    if (error) return next(error)
    if (!task) return next(new Error('Task is not found.'))
    req.task = task
    return next()
  })
})

app.get('/', tasks.list)
app.get('/tasks', tasks.list)
app.post('/tasks', tasks.markAllCompleted)
app.post('/tasks', tasks.add)
app.post('/tasks/:task_id', tasks.markCompleted);
app.delete('/tasks/:task_id', tasks.del);
app.get('/tasks/completed', tasks.completed);

app.all('*', function(req, res){
  res.status(404).send();
})

// development only
if ('development' == app.get('env')) {
  app.use(errorHandler());
}

http.createServer(app).listen(app.get('port'), function(){
  console.log('Express server listening on port ' + app.get('port'));
})
