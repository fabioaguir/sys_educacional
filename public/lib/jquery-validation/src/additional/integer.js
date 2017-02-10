$.validator.addMethod( "integer", function( value, element ) {
	return this.optional( element ) || /^-?\d+$/.test( value );
}, "Por favor, forneça um número positivo sem casas decimais" );
