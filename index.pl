persona_es(cliente).
persona_es(nuevo_cliente).

trabajo_estable(si).
trabajo_estable(no).

rango(bajo,930,2150).
rango(medio,2151,4300).
rango(alto,4301,9999999).

record_crediticio(malo).
record_crediticio(bueno).

rango_nivel_ingresos(X,Z):-rango(Y, Min,Max),X>Min,X<Max,Z=Y.
rango_tam_prestamo(X,Z):-rango(Y, Min,Max),X>Min,X<Max,Z=Y.

regla(nuevo_cliente,no,bajo,malo,bajo,negado).
regla(nuevo_cliente,no,bajo,malo,medio,negado).
regla(nuevo_cliente,no,bajo,malo,alto,negado).

regla(nuevo_cliente,no,bajo,bueno,bajo,aceptado).
regla(nuevo_cliente,no,bajo,bueno,medio,aceptado).
regla(nuevo_cliente,no,bajo,bueno,alto,negado).

regla(nuevo_cliente,no,medio,malo,bajo,negado).
regla(nuevo_cliente,no,medio,malo,medio,negado).
regla(nuevo_cliente,no,medio,malo,alto,negado).

regla(nuevo_cliente,no,medio,bueno,bajo,aceptado).
regla(nuevo_cliente,no,medio,bueno,medio,aceptado).
regla(nuevo_cliente,no,medio,bueno,alto,aceptado).

regla(nuevo_cliente,no,alto,malo,bajo,aceptado).
regla(nuevo_cliente,no,alto,malo,medio,negado).
regla(nuevo_cliente,no,alto,malo,alto,negado).

regla(nuevo_cliente,no,alto,bueno,bajo,aceptado).
regla(nuevo_cliente,no,alto,bueno,medio,aceptado).
regla(nuevo_cliente,no,alto,bueno,alto,aceptado).


regla(nuevo_cliente,si,bajo,malo,bajo,negado).
regla(nuevo_cliente,si,bajo,malo,medio,negado).
regla(nuevo_cliente,si,bajo,malo,alto,negado).

regla(nuevo_cliente,si,bajo,bueno,bajo,aceptado).
regla(nuevo_cliente,si,bajo,bueno,medio,aceptado).
regla(nuevo_cliente,si,bajo,bueno,alto,negado).

regla(nuevo_cliente,si,medio,malo,bajo,aceptado).
regla(nuevo_cliente,si,medio,malo,medio,aceptado).
regla(nuevo_cliente,si,medio,malo,alto,negado).

regla(nuevo_cliente,si,medio,bueno,bajo,aceptado).
regla(nuevo_cliente,si,medio,bueno,medio,aceptado).
regla(nuevo_cliente,si,medio,bueno,alto,aceptado).

regla(nuevo_cliente,si,alto,malo,bajo,aceptado).
regla(nuevo_cliente,si,alto,malo,medio,aceptado).
regla(nuevo_cliente,si,alto,malo,alto,negado).

regla(nuevo_cliente,si,alto,bueno,bajo,aceptado).
regla(nuevo_cliente,si,alto,bueno,medio,aceptado).
regla(nuevo_cliente,si,alto,bueno,alto,aceptado).



regla(cliente,no,bajo,malo,bajo,negado).
regla(cliente,no,bajo,malo,medio,negado).
regla(cliente,no,bajo,malo,alto,negado).

regla(cliente,no,bajo,bueno,bajo,aceptado).
regla(cliente,no,bajo,bueno,medio,aceptado).
regla(cliente,no,bajo,bueno,alto,negado).

regla(cliente,no,medio,malo,bajo,aceptado).
regla(cliente,no,medio,malo,medio,negado).
regla(cliente,no,medio,malo,alto,negado).

regla(cliente,no,medio,bueno,bajo,aceptado).
regla(cliente,no,medio,bueno,medio,aceptado).
regla(cliente,no,medio,bueno,alto,negado).

regla(cliente,no,alto,malo,bajo,aceptado).
regla(cliente,no,alto,malo,medio,aceptado).
regla(cliente,no,alto,malo,alto,negado).

regla(cliente,no,alto,bueno,bajo,aceptado).
regla(cliente,no,alto,bueno,medio,aceptado).
regla(cliente,no,alto,bueno,alto,aceptado).


regla(cliente,si,bajo,malo,bajo,negado).
regla(cliente,si,bajo,malo,medio,negado).
regla(cliente,si,bajo,malo,alto,negado).

regla(cliente,si,bajo,bueno,bajo,aceptado).
regla(cliente,si,bajo,bueno,medio,aceptado).
regla(cliente,si,bajo,bueno,alto,negado).

regla(cliente,si,medio,malo,bajo,aceptado).
regla(cliente,si,medio,malo,medio,negado).
regla(cliente,si,medio,malo,alto,negado).

regla(cliente,si,medio,bueno,bajo,aceptado).
regla(cliente,si,medio,bueno,medio,aceptado).
regla(cliente,si,medio,bueno,alto,aceptado).

regla(cliente,si,alto,malo,bajo,aceptado).
regla(cliente,si,alto,malo,medio,aceptado).
regla(cliente,si,alto,malo,alto,negado).

regla(cliente,si,alto,bueno,bajo,aceptado).
regla(cliente,si,alto,bueno,medio,aceptado).
regla(cliente,si,alto,bueno,alto,aceptado).

analizar([Tipo_cliente,Trab_esta,Ingreso_mensual,Record,Tamano]) :-
    rango_nivel_ingresos(Ingreso_mensual,Z),  rango_tam_prestamo(Tamano,A),   regla(Tipo_cliente,Trab_esta,Z,Record,A,X), write(X).



