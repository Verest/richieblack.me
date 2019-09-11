import React from 'react';

function Output(props){
  const createOutput = (value) => {
    const mark=marked(value,{sanitize: true})
    return{__html: mark};
    console.log(mark);
  };

  return(
   <div className="output" dangerouslySetInnerHTML={createOutput(props.value)}/>
  );
}

export default Output;
