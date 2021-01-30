function convertToArrayObject(data) {
   let keys = data.shift(), 
      obj = null,
      output = [];

   for (i = 0; i < data.length; i++) {
      obj = {};
      for (k = 0; k < keys.length; k++) {
         obj[keys[k]] = data[i][k];
      }
      output.push(obj);
   }

   return output;
}