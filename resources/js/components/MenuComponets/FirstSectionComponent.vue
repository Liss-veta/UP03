<template>
    <div>
        <h2>Фильтры</h2>
        <div class="d-f gap">
            <div class="d-f">
                <div>
                    <div class="filter">
                        <p>Виды</p>
                    </div>
                </div>
                <div class="last_active">
                    <div class="active">
                        <p>Дессерты</p>
                    </div>
                    <div class="active">
                        <p>Закуски</p>
                    </div>
                    <div class="active">
                        <p>Напитки</p>
                    </div>
                </div>
            </div>
            <div class="d-f">
                <div>
                    <div class="filter">
                        <p>Цена</p>
                    </div>
                </div>
                <div class="last_active">
                    <div class="active">
                        <div class="range-slider">
                            <span @change="slider">От <input v-model.number="minPrice" type="number"  min="0" max="1000"/> До <input  v-model.number="maxPrice" type="number"  min="0" max="1000"/></span>
                            <input @change="slider" v-model.number="minPrice" min="0" max="1000" step="1" type="range" />
                            <input @change="slider" v-model.number="maxPrice" min="0" max="1000" step="1" type="range" />
                            <svg width="100%" height="24"></svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                minPrice: 150,
                maxPrice: 900,
            }
        },
        methods: {
            slider: function() {
                if (this.minPrice > this.maxPrice) {
                    let tmp = this.maxPrice;
                    this.maxPrice = this.minPrice;
                    this.minPrice = tmp;
                }
            }
        }
    }
</script>

<style lang="css" scoped>
.range-slider {
  width: 300px;
  margin: auto;
  text-align: center;
  position: relative;
  height: 6em;
}

.range-slider svg,
.range-slider input[type=range] {
  position: absolute;
  left: 0;
  bottom: 0;
}

input[type=number] {
  border: none;
  color: white;
  text-align: center;
  font-size: 1.6em;
  background: transparent;
  -moz-appearance: textfield;
}

input[type=number]::-webkit-outer-spin-button,
input[type=number]::-webkit-inner-spin-button {
  -webkit-appearance: none;
}

input[type=number]:invalid,
input[type=number]:out-of-range {
  border: 2px solid #ff6347;
}

input[type=range] {
  -webkit-appearance: none;
  width: 100%;
}

input[type=range]:focus {
  outline: none;
}

input[type=range]:focus::-webkit-slider-runnable-track {
  background: white;
}

input[type=range]:focus::-ms-fill-lower {
  background: white;
}

input[type=range]:focus::-ms-fill-upper {
  background: white;
}

input[type=range]::-webkit-slider-runnable-track {
  width: 100%;
  height: 5px;
  cursor: pointer;
  animate: 0.2s;
  background: white;
  border-radius: 1px;
  box-shadow: none;
  border: 0;
}

input[type=range]::-webkit-slider-thumb {
  z-index: 2;
  position: relative;
  box-shadow: 0px 0px 0px #000;
  border: 1px solid white;
  height: 18px;
  width: 18px;
  border-radius: 25px;
  background: white;
  cursor: pointer;
  -webkit-appearance: none;
  margin-top: -7px;
}
span{
    display: flex;
}
h2{
    color: white;
    font-family: "Comfortaa", serif;
    font-size: 40px;
    margin-top: 100px;
    margin-bottom: 40px;
}
.filter{
    color: white;
    font-family: "Comfortaa", serif;
    font-size: 30px;
    width: 270px;
    height: 50px;
    background: rgb(22, 24, 27, 100%);
    display: flex;
    justify-content: center;
    align-items: center;
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
}
.active{
    color: white;
    font-family: "Comfortaa", serif;
    font-size: 30px;
    width: 270px;
    height: 50px;
    display: flex;
    justify-content: center;
    align-items: center;
    background: rgb(175, 49, 49, 58%);
    font-size: 18px;
    border-bottom: 1px white solid;
}
.d-f{
    display: flex;
    flex-direction: column;
    gap: 5px;
}
.gap{
    gap: 10px;
}
.last_active :last-child{
    border-bottom: none;
    border-bottom-left-radius: 10px;
    border-bottom-right-radius: 10px;
}
</style>
