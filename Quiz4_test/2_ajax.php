<script>

async function getDataFromAPI() {
            let response = await fetch('http://202.44.40.193/~aws/JSON/priv_hos.json')
            let rawData = await response.text()
            let objectData = JSON.parse(rawData)

            let result = document.getElementById('result')



            for (let i = 0; i < objectData.features.length; i++) {

               let tab =document.getElementById('tab');
               let newRow =document.createElement('tr');

               let no =document.createElement('td');
               let name =document.createElement('td');
               let Large =document.createElement('td');
               let Medium =document.createElement('td');
               let Small =document.createElement('td');


               no.innerHTML = i+1;
               name.innerHTML = objectData.features[i].properties.name;
               
               if(objectData.features[i].properties.num_bed >= 91){
                  Large.innerHTML = '&#10003';
               }
               else if(objectData.features[i].properties.num_bed >= 31){
                  Medium.innerHTML = '&#10003';
               }
               else{
                  Small.innerHTML = '&#10003';
               }

               newRow.appendChild(no);
               newRow.appendChild(name);
               newRow.appendChild(Large);
               newRow.appendChild(Medium);
               newRow.appendChild(Small);
               
               
               tab.appendChild(newRow);

            }
        }
        
</script>