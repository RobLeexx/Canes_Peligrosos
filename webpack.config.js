const path = require('path');
const webpack = require('webpack')

plugins: [
    new webpack.ProvidePlugin({
      mapboxgl: 'mapbox-gl',
    }),
  ]
module.exports = {
    resolve: {
        alias: {
            '@': path.resolve('resources/js'),
        },
    },
};
