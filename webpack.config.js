const path = require('path');
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const TerserPlugin = require("terser-webpack-plugin");
const CssMinimizerPlugin = require("css-minimizer-webpack-plugin");

// Check if the script is running in "watch" mode
const isDevelopment = process.argv.includes('watch');

module.exports = {
    entry: {
        main: ['./src/js/main.js', './src/scss/main.scss']
    },
    output: {
        filename: 'js/[name].min.js',
        path: path.resolve(__dirname, 'build'),
    },
    module: {
        rules: [
            {
                test: /\.js$/,
                exclude: /node_modules/,
                use: {
                    loader: 'babel-loader'
                }
            },
            {
                test: /\.scss$/,
                use: [
                    MiniCssExtractPlugin.loader,
                    'css-loader',
                    'sass-loader'
                ]
            }
        ]
    },
    plugins: [
        new MiniCssExtractPlugin({
            filename: 'css/style.min.css'
        })
    ],
    optimization: {
        minimizer: [
            new TerserPlugin(),
            new CssMinimizerPlugin(),
        ],
    },
    devtool: isDevelopment ? 'eval-source-map' : false
};
