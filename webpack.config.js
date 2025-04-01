const path = require("path");

module.exports = {
	entry: "assets/js/src/index.js", // Ajustar a la ruta según la ubicación de tu archivo principal JS
	output: {
		path: path.resolve(__dirname, "public/dist"), // Carpeta de salida de los archivos compilados
		filename: "bundle.js",
	},
	mode: "development", // Puedes cambiar a 'production' cuando hagas el build final
	devServer: {
		static: {
			directory: path.join(__dirname, "public"), // Directorio raíz para el servidor
		},
		compress: true,
		port: 9000,
		hot: true, // Activa el Hot Module Replacement
		open: true, // Abre el navegador automáticamente
	},
	module: {
		rules: [
			// Ejemplo para procesar archivos CSS
			{
				test: /\.css$/,
				use: ["style-loader", "css-loader"],
			},
			// Si en el futuro usas Babel para ES6 o JSX:
			// {
			//   test: /\.js$/,
			//   exclude: /node_modules/,
			//   use: {
			//     loader: 'babel-loader',
			//     options: {
			//       presets: ['@babel/preset-env']
			//     }
			//   }
			// }
		],
	},
};
