define({
	map: true,
	queries: [
		{
			description: 'Pencarian Lokasi',
			url: 'http://localhost/arcgis/rest/services/RTH/Peta_POI/MapServer',
			layerIds: [0],
			searchFields: ['NAMA_POI','ALAMAT_POI'],
			minChars: 2
		},
		{
			description: 'RTH',
			url: 'http://localhost:6080/arcgis/rest/services/RTH/Peta_RTH_Kota_Bogor/MapServer',
			layerIds: [0],
			searchFields: ['NAMA_TAMAN','LOKASI'],
			minChars: 2
		}
	]
});