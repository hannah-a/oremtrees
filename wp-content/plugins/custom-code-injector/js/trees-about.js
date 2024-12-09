// 
// var map = L.map('map').setView([40.2980591, -111.6879094], 18);

// L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
//     maxZoom: 19,
//     attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
// }).addTo(map);

// //multiple markers
// var marker = L.marker([40.2980591, -111.6879094]).addTo(map);
// var marker2 = L.marker([40.2980585, -111.6879088]).addTo(map);


// var circle = L.circle([51.508, -0.11], {
//     color: 'red',
//     fillColor: '#f03',
//     fillOpacity: 0.5,
//     radius: 500
// }).addTo(map);


// var polygon = L.polygon([
//     [51.509, -0.08],
//     [51.503, -0.06],
//     [51.51, -0.047]
// ]).addTo(map);


var jahjMap = L.map('map', { //custom image map
    crs: L.CRS.Simple,
    minZoom: -1,
    maxZoom: 2,
    fullscreenControl: true,
    fullscreenControlOptions: {
		position: 'topleft'
	}
})

var jahjBounds = [[0,0], [542,722]];

var jahjImage = L.imageOverlay('https://oremtrees.dgmuvu.com/wp-content/uploads/2024/11/OremCityCenterPark_DroneShot_Map.jpg', jahjBounds).addTo(jahjMap);

jahjMap.fitBounds(jahjBounds);
jahjMap.setZoom(0);

function jahjModalTree(src, name){
    return `
        <div>
            <img src="${src}" alt="${name}" style="width: 100px; height: 100px;"/>
            <h2>${name}</h2>a
        </div>
    `
}



// document.querySelector("#jajhOpenModal").addEventListener("click", function(){
//     document.querySelector('#map').remove()

//     // Open Modal 버튼 클릭시 원래 있던 <div id="map"></div>을 삭제. 새로운 <div id="map"></div>을 생성
//     // 새로운 div id = map은 기존 div와 같은 크기와 이미지를 가지고 있음
//     // tree makers는 필요없고, 새로만든 div를 document.querySelector("#fullMap").appendChild()로 추가

//     var jahjNewMap = document.createElement('div')
//     jahjNewMap.id = 'map'

//     document.querySelector("#fullMap").appendChild(jahjNewMap)

//     var jahjNewMap = L.map('map', { //custom image map
//         crs: L.CRS.Simple,
//         minZoom: -3,
//         maxZoom: 1,
//     })

//     var jahjNewBounds = [[0,0], [472,642]];

//     var jahjImage = L.imageOverlay('https://oremtrees.dgmuvu.com/wp-content/uploads/2024/11/%EC%8A%A4%ED%81%AC%EB%A6%B0%EC%83%B7-2024-11-10-172222.png', jahjNewBounds).addTo(jahjNewMap);

//     jahjNewMap.fitBounds(jahjNewBounds);

// })













// function createTreeMarkers(){
//     // console.log(e.latlng)
//     // L.marker([e.latlng.lat, e.latlng.lng]).addTo(map)
//     const location = [
//         [300, 200, 'tree1', "https://i.namu.wiki/i/aAleod1CTJs6KKGJqBz8Mkr3fcCCzbeViIyUwmT-Q2DJx-rZIYjV2E05_zBN5u0XpTk56fMuEob0h6a9BueESwfj6IWA62dD6jGK47zESLh40uJPSCDYaRxHsJbvV-8cb_L6ulIBs6Kxb1y5tWnM_w.webp"],
//         [200, 300, 'tree2',"https://i.namu.wiki/i/aAleod1CTJs6KKGJqBz8Mkr3fcCCzbeViIyUwmT-Q2DJx-rZIYjV2E05_zBN5u0XpTk56fMuEob0h6a9BueESwfj6IWA62dD6jGK47zESLh40uJPSCDYaRxHsJbvV-8cb_L6ulIBs6Kxb1y5tWnM_w.webp" ],
//         [100, 400, 'tree3', "https://i.namu.wiki/i/aAleod1CTJs6KKGJqBz8Mkr3fcCCzbeViIyUwmT-Q2DJx-rZIYjV2E05_zBN5u0XpTk56fMuEob0h6a9BueESwfj6IWA62dD6jGK47zESLh40uJPSCDYaRxHsJbvV-8cb_L6ulIBs6Kxb1y5tWnM_w.webp"],
//         [400, 500, 'tree4', "https://i.namu.wiki/i/aAleod1CTJs6KKGJqBz8Mkr3fcCCzbeViIyUwmT-Q2DJx-rZIYjV2E05_zBN5u0XpTk56fMuEob0h6a9BueESwfj6IWA62dD6jGK47zESLh40uJPSCDYaRxHsJbvV-8cb_L6ulIBs6Kxb1y5tWnM_w.webp"]
//     ]

//     location.map((loc) => {
//         L.marker([loc[0], loc[1]]).addTo(map).bindPopup(modalTree(loc[3], loc[2]))
//     })

// }
// createTreeMarkers()

// map.on('click', onMapclick)
// marker.bindPopup("<b>Hello world!</b><br>I am a popup.").openPopup();

