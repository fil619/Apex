<template>
  <div class="" style="overflow-x:auto;">
  <table class="table table-stripe table-condensed">
  <thead>
    <tr>
      <th>#</th>
      <th>Type</th>
      <th>Apr</th>
      <th>May</th>
      <th>Jun</th>
      <th>Jul</th>
      <th>Aug</th>
      <th>Sep</th>
      <th>Oct</th>
      <th>Nov</th>
      <th>Dec</th>
      <th>Jan</th>
      <th>Feb</th>
      <th>Mar</th>
      <th>Total</th>
    </tr>
  </thead>
  <tbody>
    <tr v-for="(ledger , index ) in ledgers">
      <td v-if="ledger" >{{index+1}}</td>
      <td class="type">{{ledger.ledger}}</td>
      <td>{{sumApr[index]}}</td>
      <td>{{sumMay[index]}}</td>
      <td>{{sumJun[index]}}</td>
      <td>{{sumJul[index]}}</td>
      <td>{{sumAug[index]}}</td>
      <td>{{sumSep[index]}}</td>
      <td>{{sumOct[index]}}</td>
      <td>{{sumNov[index]}}</td>
      <td>{{sumDec[index]}}</td>
      <td>{{sumJan[index]}}</td>
      <td>{{sumFeb[index]}}</td>
      <td>{{sumMar[index]}}</td>
      <td  style="background-color:#e0e0e0 ; font-size: 15px; ">{{Total[index]}}</td>
    </tr>
    <tr>
      <td colspan="15"><h3>Total={{yearTotal}}</h3> </td>
    </tr>
  </tbody>
</table>
</div>
</template>

<script>
export default {
  data(){
      return {
          ledgers:{ledger:'', id: ''},
          sumJan:{},
          sumFeb:{},
          sumMar:{},
          sumApr:{},
          sumMay:{},
          sumJun:{},
          sumJul:{},
          sumAug:{},
          sumSep:{},
          sumOct:{},
          sumNov:{},
          sumDec:{},
          Total:{},
          yearTotal:''
              }
        },
        mounted()
        {
          this.getledgers();
          this.getSum();
          this.getTotal();
        },
        methods:
        {
          getledgers()
          {
              axios.get('/ledger')
              .then(response => {
              this.ledgers = response.data.ledger;
              });
          },
          getSum()
          {
            axios.get('/indirect/sum',{
              params: {
                      month: '04'
                      }
            })
            .then(response => {
            this.sumApr = response.data ;
          });

          axios.get('/indirect/sum',{
            params: {
                    month: '05'
                    }
          })
          .then(response => {
          this.sumMay = response.data ;
        });
        axios.get('/indirect/sum',{
          params: {
                  month: '06'
                  }
        })
        .then(response => {
        this.sumJun = response.data ;
      });
      axios.get('/indirect/sum',{
        params: {
                month: '07'
                }
      })
      .then(response => {
      this.sumJul = response.data ;
      });
      axios.get('/indirect/sum',{
        params: {
                month: '08'
                }
      })
      .then(response => {
      this.sumAug = response.data ;
      });
      axios.get('/indirect/sum',{
        params: {
                month: '09'
                }
      })
      .then(response => {
      this.sumSep = response.data ;
      });
      axios.get('/indirect/sum',{
        params: {
                month: '010'
                }
      })
      .then(response => {
      this.sumOct = response.data ;
      });
      axios.get('/indirect/sum',{
        params: {
                month: '011'
                }
      })
      .then(response => {
      this.sumNov = response.data ;
      });
      axios.get('/indirect/sum',{
        params: {
                month: '12'
                }
      })
      .then(response => {
      this.sumDec = response.data ;
      });
            axios.get('/indirect/sum',{
              params: {
                      month: '01'
                      }
            })
            .then(response => {
            this.sumJan = response.data ;
          });

          axios.get('/indirect/sum',{
            params: {
                    month: '02'
                    }
          })
          .then(response => {
          this.sumFeb = response.data ;
        });

        axios.get('/indirect/sum',{
          params: {
                  month: '03'
                  }
        })
        .then(response => {
        this.sumMar = response.data ;
      });
    },
    getTotal()
    {
      axios.get('/indirect/total')
      .then(response => {
        this.yearTotal = 0;
      this.Total = response.data ;
      for (var i = 0; i < this.Total.length; i++) {
        var integer = parseInt(this.Total[i]);
        this.yearTotal = this.yearTotal + integer;
      }
    });
    }
        }
}
</script>
<style media="screen" scoped>
  table
  {
    font-size: 15px;
    font-weight: bold;
  }
  td
  {
    color: black;
    border: 1px solid ;
    width: 70px;
    height: 10px;
  }
  td.type
  {
    width: 200px !important;
  }
  th{
    background-color: black;
    color: white;
  }

</style>
