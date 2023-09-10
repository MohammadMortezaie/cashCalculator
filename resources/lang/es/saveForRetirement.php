<?php

return [
    'h1' => "Calculadora de Ahorro para la Jubilación",
    'seoTitle' => "Calculadora gratuita de ahorro para la jubilación",
    'seoDescription' => "Utilice nuestra calculadora gratuita de ahorro para la jubilación para estimar sus metas de ahorro. Comprenda la fórmula del interés compuesto, calcule contribuciones mensuales o anuales y genere un informe PDF de forma gratuita. Asegure su futuro financiero hoy mismo.",
    'future_value_formula' => 'La fórmula utilizada para calcular el valor futuro de sus ahorros actuales se basa en el interés compuesto. Estima cuánto crecerán sus ahorros actuales con el tiempo a una tasa de interés anual fija.',
    'future_value_equation' => 'Valor Futuro (VF) = Valor Presente (VP) * (1 + Tasa de Interés)^Número de Años (n)',
    'fv_description' => 'VF (Valor Futuro) es la cantidad a la que crecerán sus ahorros en el futuro.',
    'pv_description' => 'VP (Valor Presente) son sus ahorros actuales.',
    'interest_rate_description' => 'La Tasa de Interés es la tasa de interés anual (expresada como decimal).',
    'years_description' => 'Número de Años es la cantidad de años en los que su dinero está invertido o ahorrado.',

    'amount_needed' => 'El monto necesario representa la cantidad adicional que necesita ahorrar para alcanzar su objetivo de ahorro para la jubilación deseado. Se calcula restando el valor futuro estimado (VF) de su objetivo de ahorro para la jubilación (neededAmount).',

    'monthly_payment_formula' => 'El cálculo del pago mensual determina cuánto necesita ahorrar cada mes para alcanzar su objetivo de jubilación. Utiliza el concepto de un pago de anualidad, que es la cantidad fija que necesita invertir regularmente para lograr un objetivo futuro específico.',
    'monthly_payment_equation' => 'Pago Mensual = (Monto Necesario * Tasa de Interés Mensual) / (1 - (1 + Tasa de Interés Mensual)^(-Número de Meses))',
    'monthly_payment_description' => 'El Pago Mensual es la cantidad que necesita ahorrar cada mes.',
    'monthly_payment_amount_needed_description' => 'El Monto Necesario es la cantidad adicional que necesita ahorrar (amountNeeded).',
    'monthly_payment_interest_rate_description' => 'La Tasa de Interés Mensual es el equivalente mensual de su tasa de interés anual (invReturn dividido por 12).',
    'monthly_payment_months_description' => 'El Número de Meses es el total de meses hasta su jubilación (añosParaAhorrar multiplicado por 12).',

    'yearly_payment' => 'El cálculo del Pago Anual es similar al pago mensual pero considera contribuciones anuales. Calcula cuánto necesita ahorrar anualmente para alcanzar su objetivo de jubilación.',
    'yearly_payment_equation' => 'Pago Anual = Monto Necesario / ((1 - (1 + Tasa de Interés Anual)^(-Número de Años)) / (Tasa de Interés Anual))',
    'yearly_payment_description' => 'El Pago Anual es la cantidad que necesita ahorrar cada año.',
    'yearly_payment_amount_needed_description' => 'El Monto Necesario es la cantidad adicional que necesita ahorrar (amountNeeded).',
    'yearly_payment_interest_rate_description' => 'La Tasa de Interés Anual es su tasa de interés anual (invReturn como decimal).',
    'yearly_payment_years_description' => 'El Número de Años es la cantidad total de años hasta su jubilación (añosParaAhorrar).',
    'your_age_now' => 'Su edad actual',
    'your_planned_retirement_age' => 'Su edad de jubilación planificada',
    'amount_needed_at_retirement_age' => 'Monto necesario en la edad de jubilación',
    'your_retirement_savings_now' => 'Sus ahorros de jubilación actuales',
    'average_investment_return' => 'Rendimiento promedio de la inversión',
    'calculate_button' => 'Calcular',
    'clear_button' => 'Limpiar',

    'results' => 'Resultados:',
    'monthly_savings_plan' => 'Si ahorra cada mes hasta los 67 años',
    'amount_to_save_monthly' => 'Monto a ahorrar cada mes:',
    'total_principal' => 'Capital total:',
    'total_interest' => 'Intereses totales:',
    'yearly_savings_plan' => 'Si ahorra cada año hasta los 67 años',
    'amount_to_save_yearly' => 'Monto a ahorrar cada año:',
    'lump_sum_savings_plan' => 'Si lo tiene ahora',
    'additional_amount_needed' => 'Monto adicional necesario:',
];
