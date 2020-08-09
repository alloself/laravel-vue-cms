module.exports = {
  lintOnSave: false,
  outputDir: '../../../public/assets/admin',
  publicPath: process.env.NODE_ENV === 'production'
    ? '/assets/admin/'
    : '/admin',
  indexPath: process.env.NODE_ENV === 'production'
    ? '../../../resources/views/admin.blade.php'
    : 'index.html'
}
