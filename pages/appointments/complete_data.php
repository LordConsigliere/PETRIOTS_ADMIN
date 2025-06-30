<?php
include('dbcon.php');

$aptid = $_POST['apt_id'];

$ref = $database->getReference("Appointments/$aptid");


$name = $ref->getChild('pet_name')->getValue();
$apt_date = $ref->getChild('apt_date')->getValue();
$apt_time = $ref->getChild('apt_time')->getValue();
$apt_type = $ref->getChild('apt_type')->getValue();

$pet_id = $ref->getChild('pet_id')->getValue();
$refer = $database->getReference("Pets/$pet_id");
$photoUrl = $refer->getChild('photoUrl')->getValue();
$breed = $refer->getChild('breed')->getValue();
$gender = $refer->getChild('gender')->getValue();
$weight = $refer->getChild('weight')->getValue();
$ownername = $refer->getChild('ownername')->getValue();


$refresult = $database->getReference("Appointments/$aptid/aptresult");

$apt_diag = $refresult->getChild('apt_diag')->getValue();
$apt_find = $refresult->getChild('apt_find')->getValue();
$apt_info = $refresult->getChild('apt_info')->getValue();
$apt_med = $refresult->getChild('apt_med')->getValue();
$apt_vac = $refresult->getChild('apt_vac')->getValue();


$diagValues = array();

$analyticsRef = $database->getReference("Analytics");
$query = $analyticsRef->orderByChild("pet_id")->equalTo($pet_id);
$dataSnapshot = $query->getSnapshot();

if ($dataSnapshot->hasChildren()) {
    $childData = $dataSnapshot->getValue();

    foreach ($childData as $childKey => $childValue) {
        $diagValue = $childValue['diag'];
        $dateVal = $childValue['date'];


        if ($diagValue === 'Rabies') {
            // Access the "appetite" and "aggressive" properties
            $appetite = $childValue['appetite'] == 1 ? 'Loss Appetite' : '';
            $aggressive = $childValue['aggressive'] == 1 ? 'Aggressive' : '';
            $breath = $childValue['breath'] == 1 ? 'Dsypnea' : '';
            $cough_sneeze = $childValue['cough_sneeze'] == 1 ? 'Coughing/Sneezing' : '';
            $dehy = $childValue['dehy'] == 1 ? 'Dehydrated' : '';
            $diarrhea = $childValue['diarrhea'] == 1 ? 'Diarrhea' : '';
            $drool = $childValue['drool'] == 1 ? 'Drooling' : '';
            $fever = $childValue['fever'] == 1 ? 'Fever' : '';
            $jaundice = $childValue['jaundice'] == 1 ? 'Jaundice' : '';
            $lethargy = $childValue['lethargy'] == 1 ? 'Lethargy' : '';
            $nasal  = $childValue['nasal'] == 1 ? 'Nasal discharge' : '';
            $nosebleed  = $childValue['nosebleed'] == 1 ? 'Nosebleed' : '';
            $seizure  = $childValue['seizure'] == 1 ? 'Seizure' : '';
            $urine  = $childValue['urine'] == 1 ? 'Frequently Urinating/Drinking' : '';
            $vomit  = $childValue['vomit'] == 1 ? 'Vomiting' : '';
            $weight_loss  = $childValue['weight_loss'] == 1 ? 'Weight loss' : '';


            $symptomVariables = array(
                'appetite' => 'Loss Appetite',
                'aggressive' => 'Aggressive',
                'breath' => 'Dsypnea',
                'cough_sneeze' => 'Coughing/Sneezing',
                'dehy' => 'Dehydrated',
                'diarrhea' => 'Diarrhea',
                'drool' => 'Drooling',
                'fever' => 'Fever',
                'jaundice' => 'Jaundice',
                'lethargy' => 'Lethargy',
                'nasal' => 'Nasal discharge',
                'nosebleed' => 'Nosebleed',
                'seizure' => 'Seizure',
                'urine' => 'Frequently Urinating/Drinking',
                'vomit' => 'Vomiting',
                'weight_loss' => 'Weight loss'
            );
            
            $symptoms = array();
            
            foreach ($symptomVariables as $variable => $label) {
                if ($childValue[$variable] == 1) {
                    $symptoms[] = $label;
                }
            }
            
            
            if (!empty($symptoms)) {
                $diagValues[] =  '<b>' . $diagValue .'('.$dateVal.')'. '</b>: ' . implode(', ', $symptoms);

            }
            // Process the values as needed
        }
        if ($diagValue === 'Canine Distemper') {
            // Access the "appetite" and "aggressive" properties
            $appetite = $childValue['appetite'] == 1 ? 'Loss Appetite' : '';
            $aggressive = $childValue['aggressive'] == 1 ? 'Aggressive' : '';
            $breath = $childValue['breath'] == 1 ? 'Dsypnea' : '';
            $cough_sneeze = $childValue['cough_sneeze'] == 1 ? 'Coughing/Sneezing' : '';
            $dehy = $childValue['dehy'] == 1 ? 'Dehydrated' : '';
            $diarrhea = $childValue['diarrhea'] == 1 ? 'Diarrhea' : '';
            $drool = $childValue['drool'] == 1 ? 'Drooling' : '';
            $fever = $childValue['fever'] == 1 ? 'Fever' : '';
            $jaundice = $childValue['jaundice'] == 1 ? 'Jaundice' : '';
            $lethargy = $childValue['lethargy'] == 1 ? 'Lethargy' : '';
            $nasal  = $childValue['nasal'] == 1 ? 'Nasal discharge' : '';
            $nosebleed  = $childValue['nosebleed'] == 1 ? 'Nosebleed' : '';
            $seizure  = $childValue['seizure'] == 1 ? 'Seizure' : '';
            $urine  = $childValue['urine'] == 1 ? 'Frequently Urinating/Drinking' : '';
            $vomit  = $childValue['vomit'] == 1 ? 'Vomiting' : '';
            $weight_loss  = $childValue['weight_loss'] == 1 ? 'Weight loss' : '';


            $symptomVariables = array(
                'appetite' => 'Loss Appetite',
                'aggressive' => 'Aggressive',
                'breath' => 'Dsypnea',
                'cough_sneeze' => 'Coughing/Sneezing',
                'dehy' => 'Dehydrated',
                'diarrhea' => 'Diarrhea',
                'drool' => 'Drooling',
                'fever' => 'Fever',
                'jaundice' => 'Jaundice',
                'lethargy' => 'Lethargy',
                'nasal' => 'Nasal discharge',
                'nosebleed' => 'Nosebleed',
                'seizure' => 'Seizure',
                'urine' => 'Frequently Urinating/Drinking',
                'vomit' => 'Vomiting',
                'weight_loss' => 'Weight loss'
            );
            
            $symptoms = array();
            
            foreach ($symptomVariables as $variable => $label) {
                if ($childValue[$variable] == 1) {
                    $symptoms[] = $label;
                }
            }
            
            if (!empty($symptoms)) {
                $diagValues[] =  '<b>' . $diagValue .'('.$dateVal.')'. '</b>: ' . implode(', ', $symptoms);
            }
            // Process the values as needed
        }
        if ($diagValue === 'Gastroenteritis') {
            // Access the "appetite" and "aggressive" properties
            $appetite = $childValue['appetite'] == 1 ? 'Loss Appetite' : '';
            $aggressive = $childValue['aggressive'] == 1 ? 'Aggressive' : '';
            $breath = $childValue['breath'] == 1 ? 'Dsypnea' : '';
            $cough_sneeze = $childValue['cough_sneeze'] == 1 ? 'Coughing/Sneezing' : '';
            $dehy = $childValue['dehy'] == 1 ? 'Dehydrated' : '';
            $diarrhea = $childValue['diarrhea'] == 1 ? 'Diarrhea' : '';
            $drool = $childValue['drool'] == 1 ? 'Drooling' : '';
            $fever = $childValue['fever'] == 1 ? 'Fever' : '';
            $jaundice = $childValue['jaundice'] == 1 ? 'Jaundice' : '';
            $lethargy = $childValue['lethargy'] == 1 ? 'Lethargy' : '';
            $nasal  = $childValue['nasal'] == 1 ? 'Nasal discharge' : '';
            $nosebleed  = $childValue['nosebleed'] == 1 ? 'Nosebleed' : '';
            $seizure  = $childValue['seizure'] == 1 ? 'Seizure' : '';
            $urine  = $childValue['urine'] == 1 ? 'Frequently Urinating/Drinking' : '';
            $vomit  = $childValue['vomit'] == 1 ? 'Vomiting' : '';
            $weight_loss  = $childValue['weight_loss'] == 1 ? 'Weight loss' : '';


            $symptomVariables = array(
                'appetite' => 'Loss Appetite',
                'aggressive' => 'Aggressive',
                'breath' => 'Dsypnea',
                'cough_sneeze' => 'Coughing/Sneezing',
                'dehy' => 'Dehydrated',
                'diarrhea' => 'Diarrhea',
                'drool' => 'Drooling',
                'fever' => 'Fever',
                'jaundice' => 'Jaundice',
                'lethargy' => 'Lethargy',
                'nasal' => 'Nasal discharge',
                'nosebleed' => 'Nosebleed',
                'seizure' => 'Seizure',
                'urine' => 'Frequently Urinating/Drinking',
                'vomit' => 'Vomiting',
                'weight_loss' => 'Weight loss'
            );
            
            $symptoms = array();
            
            foreach ($symptomVariables as $variable => $label) {
                if ($childValue[$variable] == 1) {
                    $symptoms[] = $label;
                }
            }
            
            
            if (!empty($symptoms)) {
                $diagValues[] =  '<b>' . $diagValue .'('.$dateVal.')'. '</b>: ' . implode(', ', $symptoms);
            }
            // Process the values as needed
        }

        if ($diagValue === 'Leptospirosis') {
            // Access the "appetite" and "aggressive" properties
            $appetite = $childValue['appetite'] == 1 ? 'Loss Appetite' : '';
            $aggressive = $childValue['aggressive'] == 1 ? 'Aggressive' : '';
            $breath = $childValue['breath'] == 1 ? 'Dsypnea' : '';
            $cough_sneeze = $childValue['cough_sneeze'] == 1 ? 'Coughing/Sneezing' : '';
            $dehy = $childValue['dehy'] == 1 ? 'Dehydrated' : '';
            $diarrhea = $childValue['diarrhea'] == 1 ? 'Diarrhea' : '';
            $drool = $childValue['drool'] == 1 ? 'Drooling' : '';
            $fever = $childValue['fever'] == 1 ? 'Fever' : '';
            $jaundice = $childValue['jaundice'] == 1 ? 'Jaundice' : '';
            $lethargy = $childValue['lethargy'] == 1 ? 'Lethargy' : '';
            $nasal  = $childValue['nasal'] == 1 ? 'Nasal discharge' : '';
            $nosebleed  = $childValue['nosebleed'] == 1 ? 'Nosebleed' : '';
            $seizure  = $childValue['seizure'] == 1 ? 'Seizure' : '';
            $urine  = $childValue['urine'] == 1 ? 'Frequently Urinating/Drinking' : '';
            $vomit  = $childValue['vomit'] == 1 ? 'Vomiting' : '';
            $weight_loss  = $childValue['weight_loss'] == 1 ? 'Weight loss' : '';


            $symptomVariables = array(
                'appetite' => 'Loss Appetite',
                'aggressive' => 'Aggressive',
                'breath' => 'Dsypnea',
                'cough_sneeze' => 'Coughing/Sneezing',
                'dehy' => 'Dehydrated',
                'diarrhea' => 'Diarrhea',
                'drool' => 'Drooling',
                'fever' => 'Fever',
                'jaundice' => 'Jaundice',
                'lethargy' => 'Lethargy',
                'nasal' => 'Nasal discharge',
                'nosebleed' => 'Nosebleed',
                'seizure' => 'Seizure',
                'urine' => 'Frequently Urinating/Drinking',
                'vomit' => 'Vomiting',
                'weight_loss' => 'Weight loss'
            );
            
            $symptoms = array();
            
            foreach ($symptomVariables as $variable => $label) {
                if ($childValue[$variable] == 1) {
                    $symptoms[] = $label;
                }
            }
            
            
            if (!empty($symptoms)) {
                $diagValues[] =  '<b>' . $diagValue .'('.$dateVal.')'. '</b>: ' . implode(', ', $symptoms);
            }
            // Process the values as needed
        }

        if ($diagValue === 'Canine Parvovirus') {
            // Access the "appetite" and "aggressive" properties
            $appetite = $childValue['appetite'] == 1 ? 'Loss Appetite' : '';
            $aggressive = $childValue['aggressive'] == 1 ? 'Aggressive' : '';
            $breath = $childValue['breath'] == 1 ? 'Dsypnea' : '';
            $cough_sneeze = $childValue['cough_sneeze'] == 1 ? 'Coughing/Sneezing' : '';
            $dehy = $childValue['dehy'] == 1 ? 'Dehydrated' : '';
            $diarrhea = $childValue['diarrhea'] == 1 ? 'Diarrhea' : '';
            $drool = $childValue['drool'] == 1 ? 'Drooling' : '';
            $fever = $childValue['fever'] == 1 ? 'Fever' : '';
            $jaundice = $childValue['jaundice'] == 1 ? 'Jaundice' : '';
            $lethargy = $childValue['lethargy'] == 1 ? 'Lethargy' : '';
            $nasal  = $childValue['nasal'] == 1 ? 'Nasal discharge' : '';
            $nosebleed  = $childValue['nosebleed'] == 1 ? 'Nosebleed' : '';
            $seizure  = $childValue['seizure'] == 1 ? 'Seizure' : '';
            $urine  = $childValue['urine'] == 1 ? 'Frequently Urinating/Drinking' : '';
            $vomit  = $childValue['vomit'] == 1 ? 'Vomiting' : '';
            $weight_loss  = $childValue['weight_loss'] == 1 ? 'Weight loss' : '';


            $symptomVariables = array(
                'appetite' => 'Loss Appetite',
                'aggressive' => 'Aggressive',
                'breath' => 'Dsypnea',
                'cough_sneeze' => 'Coughing/Sneezing',
                'dehy' => 'Dehydrated',
                'diarrhea' => 'Diarrhea',
                'drool' => 'Drooling',
                'fever' => 'Fever',
                'jaundice' => 'Jaundice',
                'lethargy' => 'Lethargy',
                'nasal' => 'Nasal discharge',
                'nosebleed' => 'Nosebleed',
                'seizure' => 'Seizure',
                'urine' => 'Frequently Urinating/Drinking',
                'vomit' => 'Vomiting',
                'weight_loss' => 'Weight loss'
            );
            
            $symptoms = array();
            
            foreach ($symptomVariables as $variable => $label) {
                if ($childValue[$variable] == 1) {
                    $symptoms[] = $label;
                }
            }
            
            
            if (!empty($symptoms)) {
                $diagValues[] =  '<b>' . $diagValue .'('.$dateVal.')'. '</b>: ' . implode(', ', $symptoms);
            }
            // Process the values as needed
        }
        if ($diagValue === 'Canine infectious respiratory disease') {
            // Access the "appetite" and "aggressive" properties
            $appetite = $childValue['appetite'] == 1 ? 'Loss Appetite' : '';
            $aggressive = $childValue['aggressive'] == 1 ? 'Aggressive' : '';
            $breath = $childValue['breath'] == 1 ? 'Dsypnea' : '';
            $cough_sneeze = $childValue['cough_sneeze'] == 1 ? 'Coughing/Sneezing' : '';
            $dehy = $childValue['dehy'] == 1 ? 'Dehydrated' : '';
            $diarrhea = $childValue['diarrhea'] == 1 ? 'Diarrhea' : '';
            $drool = $childValue['drool'] == 1 ? 'Drooling' : '';
            $fever = $childValue['fever'] == 1 ? 'Fever' : '';
            $jaundice = $childValue['jaundice'] == 1 ? 'Jaundice' : '';
            $lethargy = $childValue['lethargy'] == 1 ? 'Lethargy' : '';
            $nasal  = $childValue['nasal'] == 1 ? 'Nasal discharge' : '';
            $nosebleed  = $childValue['nosebleed'] == 1 ? 'Nosebleed' : '';
            $seizure  = $childValue['seizure'] == 1 ? 'Seizure' : '';
            $urine  = $childValue['urine'] == 1 ? 'Frequently Urinating/Drinking' : '';
            $vomit  = $childValue['vomit'] == 1 ? 'Vomiting' : '';
            $weight_loss  = $childValue['weight_loss'] == 1 ? 'Weight loss' : '';


            $symptomVariables = array(
                'appetite' => 'Loss Appetite',
                'aggressive' => 'Aggressive',
                'breath' => 'Dsypnea',
                'cough_sneeze' => 'Coughing/Sneezing',
                'dehy' => 'Dehydrated',
                'diarrhea' => 'Diarrhea',
                'drool' => 'Drooling',
                'fever' => 'Fever',
                'jaundice' => 'Jaundice',
                'lethargy' => 'Lethargy',
                'nasal' => 'Nasal discharge',
                'nosebleed' => 'Nosebleed',
                'seizure' => 'Seizure',
                'urine' => 'Frequently Urinating/Drinking',
                'vomit' => 'Vomiting',
                'weight_loss' => 'Weight loss'
            );
            
            $symptoms = array();
            
            foreach ($symptomVariables as $variable => $label) {
                if ($childValue[$variable] == 1) {
                    $symptoms[] = $label;
                }
            }
            
            
            if (!empty($symptoms)) {
                $diagValues[] =  '<b>' . $diagValue .'('.$dateVal.')'. '</b>: ' . implode(', ', $symptoms);
            }
            // Process the values as needed
        }
        if ($diagValue === 'Common Cold') {
            // Access the "appetite" and "aggressive" properties
            $appetite = $childValue['appetite'] == 1 ? 'Loss Appetite' : '';
            $aggressive = $childValue['aggressive'] == 1 ? 'Aggressive' : '';
            $breath = $childValue['breath'] == 1 ? 'Dsypnea' : '';
            $cough_sneeze = $childValue['cough_sneeze'] == 1 ? 'Coughing/Sneezing' : '';
            $dehy = $childValue['dehy'] == 1 ? 'Dehydrated' : '';
            $diarrhea = $childValue['diarrhea'] == 1 ? 'Diarrhea' : '';
            $drool = $childValue['drool'] == 1 ? 'Drooling' : '';
            $fever = $childValue['fever'] == 1 ? 'Fever' : '';
            $jaundice = $childValue['jaundice'] == 1 ? 'Jaundice' : '';
            $lethargy = $childValue['lethargy'] == 1 ? 'Lethargy' : '';
            $nasal  = $childValue['nasal'] == 1 ? 'Nasal discharge' : '';
            $nosebleed  = $childValue['nosebleed'] == 1 ? 'Nosebleed' : '';
            $seizure  = $childValue['seizure'] == 1 ? 'Seizure' : '';
            $urine  = $childValue['urine'] == 1 ? 'Frequently Urinating/Drinking' : '';
            $vomit  = $childValue['vomit'] == 1 ? 'Vomiting' : '';
            $weight_loss  = $childValue['weight_loss'] == 1 ? 'Weight loss' : '';


            $symptomVariables = array(
                'appetite' => 'Loss Appetite',
                'aggressive' => 'Aggressive',
                'breath' => 'Dsypnea',
                'cough_sneeze' => 'Coughing/Sneezing',
                'dehy' => 'Dehydrated',
                'diarrhea' => 'Diarrhea',
                'drool' => 'Drooling',
                'fever' => 'Fever',
                'jaundice' => 'Jaundice',
                'lethargy' => 'Lethargy',
                'nasal' => 'Nasal discharge',
                'nosebleed' => 'Nosebleed',
                'seizure' => 'Seizure',
                'urine' => 'Frequently Urinating/Drinking',
                'vomit' => 'Vomiting',
                'weight_loss' => 'Weight loss'
            );
            
            $symptoms = array();
            
            foreach ($symptomVariables as $variable => $label) {
                if ($childValue[$variable] == 1) {
                    $symptoms[] = $label;
                }
            }
            
            
            if (!empty($symptoms)) {
                $diagValues[] =  '<b>' . $diagValue .'('.$dateVal.')'. '</b>: ' . implode(', ', $symptoms);
            }
            // Process the values as needed
        }
        if ($diagValue === 'Kennel Cough') {
            // Access the "appetite" and "aggressive" properties
            $appetite = $childValue['appetite'] == 1 ? 'Loss Appetite' : '';
            $aggressive = $childValue['aggressive'] == 1 ? 'Aggressive' : '';
            $breath = $childValue['breath'] == 1 ? 'Dsypnea' : '';
            $cough_sneeze = $childValue['cough_sneeze'] == 1 ? 'Coughing/Sneezing' : '';
            $dehy = $childValue['dehy'] == 1 ? 'Dehydrated' : '';
            $diarrhea = $childValue['diarrhea'] == 1 ? 'Diarrhea' : '';
            $drool = $childValue['drool'] == 1 ? 'Drooling' : '';
            $fever = $childValue['fever'] == 1 ? 'Fever' : '';
            $jaundice = $childValue['jaundice'] == 1 ? 'Jaundice' : '';
            $lethargy = $childValue['lethargy'] == 1 ? 'Lethargy' : '';
            $nasal  = $childValue['nasal'] == 1 ? 'Nasal discharge' : '';
            $nosebleed  = $childValue['nosebleed'] == 1 ? 'Nosebleed' : '';
            $seizure  = $childValue['seizure'] == 1 ? 'Seizure' : '';
            $urine  = $childValue['urine'] == 1 ? 'Frequently Urinating/Drinking' : '';
            $vomit  = $childValue['vomit'] == 1 ? 'Vomiting' : '';
            $weight_loss  = $childValue['weight_loss'] == 1 ? 'Weight loss' : '';


            $symptomVariables = array(
                'appetite' => 'Loss Appetite',
                'aggressive' => 'Aggressive',
                'breath' => 'Dsypnea',
                'cough_sneeze' => 'Coughing/Sneezing',
                'dehy' => 'Dehydrated',
                'diarrhea' => 'Diarrhea',
                'drool' => 'Drooling',
                'fever' => 'Fever',
                'jaundice' => 'Jaundice',
                'lethargy' => 'Lethargy',
                'nasal' => 'Nasal discharge',
                'nosebleed' => 'Nosebleed',
                'seizure' => 'Seizure',
                'urine' => 'Frequently Urinating/Drinking',
                'vomit' => 'Vomiting',
                'weight_loss' => 'Weight loss'
            );
            
            $symptoms = array();
            
            foreach ($symptomVariables as $variable => $label) {
                if ($childValue[$variable] == 1) {
                    $symptoms[] = $label;
                }
            }
            
            
            if (!empty($symptoms)) {
                $diagValues[] =  '<b>' . $diagValue .'('.$dateVal.')'. '</b>: ' . implode(', ', $symptoms);
            }
            // Process the values as needed
        }
        if ($diagValue === 'Unknown disease please go to the clinic for more information') {
            // Access the "appetite" and "aggressive" properties
            $appetite = $childValue['appetite'] == 1 ? 'Loss Appetite' : '';
            $aggressive = $childValue['aggressive'] == 1 ? 'Aggressive' : '';
            $breath = $childValue['breath'] == 1 ? 'Dsypnea' : '';
            $cough_sneeze = $childValue['cough_sneeze'] == 1 ? 'Coughing/Sneezing' : '';
            $dehy = $childValue['dehy'] == 1 ? 'Dehydrated' : '';
            $diarrhea = $childValue['diarrhea'] == 1 ? 'Diarrhea' : '';
            $drool = $childValue['drool'] == 1 ? 'Drooling' : '';
            $fever = $childValue['fever'] == 1 ? 'Fever' : '';
            $jaundice = $childValue['jaundice'] == 1 ? 'Jaundice' : '';
            $lethargy = $childValue['lethargy'] == 1 ? 'Lethargy' : '';
            $nasal  = $childValue['nasal'] == 1 ? 'Nasal discharge' : '';
            $nosebleed  = $childValue['nosebleed'] == 1 ? 'Nosebleed' : '';
            $seizure  = $childValue['seizure'] == 1 ? 'Seizure' : '';
            $urine  = $childValue['urine'] == 1 ? 'Frequently Urinating/Drinking' : '';
            $vomit  = $childValue['vomit'] == 1 ? 'Vomiting' : '';
            $weight_loss  = $childValue['weight_loss'] == 1 ? 'Weight loss' : '';


            $symptomVariables = array(
                'appetite' => 'Loss Appetite',
                'aggressive' => 'Aggressive',
                'breath' => 'Dsypnea',
                'cough_sneeze' => 'Coughing/Sneezing',
                'dehy' => 'Dehydrated',
                'diarrhea' => 'Diarrhea',
                'drool' => 'Drooling',
                'fever' => 'Fever',
                'jaundice' => 'Jaundice',
                'lethargy' => 'Lethargy',
                'nasal' => 'Nasal discharge',
                'nosebleed' => 'Nosebleed',
                'seizure' => 'Seizure',
                'urine' => 'Frequently Urinating/Drinking',
                'vomit' => 'Vomiting',
                'weight_loss' => 'Weight loss'
            );
            
            $symptoms = array();
            
            foreach ($symptomVariables as $variable => $label) {
                if ($childValue[$variable] == 1) {
                    $symptoms[] = $label;
                }
            }
            
            
            if (!empty($symptoms)) {
                $diagValues[] =  '<b>' . $diagValue .'('.$dateVal.')'. '</b>: ' . implode(', ', $symptoms);
            }
            // Process the values as needed
        }
  
        // Process each child node
        // $childKey represents the key of the child node
        // $childValue represents the value of the child node
    }
} else {
    // No matching node found for the given $pet_id
}

echo '<script>';
echo 'console.log(' . json_encode($diagValues) . ');';
echo '</script>';


function sortByDate($a, $b) {
    // Extract the dates from the strings
    preg_match('/\((.*?)\)/', $a, $aDate);
    preg_match('/\((.*?)\)/', $b, $bDate);
    
    // Convert the dates to timestamps
    $aTimestamp = strtotime($aDate[1]);
    $bTimestamp = strtotime($bDate[1]);
    
    // Compare the timestamps
    return $bTimestamp - $aTimestamp; // Sort in descending order (latest date first)
}

// Sort the array using the custom comparison function
usort($diagValues, 'sortByDate');


?>
<div class="row">
                <div class="card card-primary card-outline" style="margin-left:35px;margin-right:35px; width: 500px;" >
                            <div class="card-body box-profile">
                                <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle"
                                    src=<?php echo $photoUrl ?>
                                    alt="User profile picture" style="object-fit:cover; height:140px;width:140px;">
                                </div>

                                <h3 class="profile-username text-center"><?= $name ?></h3>
                                <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Breed:</b> <a class="float-right"><?= $breed ?></a>
                                    
                                </li>
                                <li class="list-group-item">
                                    <b>Gender:</b> <a class="float-right"><?= $gender ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Weight:</b> <a class="float-right"><?= $weight ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Owner name:</b> <a class="float-right"><?= $ownername ?></a>
                                </li>
                                </ul>
                            </div>
                            <!-- /.card-body -->
                            </div>
                      
            <div class="card card-primary" style="margin-left:10px; width: 480px; font-size:12px" >   
                    <div class="card-body">	
                    <div class="form-group">
                            <label>Type of appointment:</label>
                            <input type="text" class="form-control" id="oldate" value="<?= $apt_type ?>" style="font-size:11px" readonly/>
                            </div>     
                        <div class="form-group">
                            <label>Date of appointment:</label>
                            <input type="text" class="form-control" id="oldate" value="<?= $apt_date ?>" style="font-size:11px" readonly/>
                            </div>                  
                        <div class="form-group">
                            <label>Time:</label>
                                 <input type="text" class="form-control" id="oldtime" value="<?php echo $apt_time ?>" style="font-size:11px" readonly/>         
                             </div>
                       <div class="form-group">
                            <label>Physical Examination findings: </label>
                            <textarea class="form-control" id ="setaptfind" rows="4" placeholder="N/A" style="font-size:11px"  readonly><?= $apt_find?></textarea>  
                             </div>
                        <div class="form-group">
                            <label>Diagnosis: </label>
                            <textarea class="form-control" id ="setaptdiag" rows="3" placeholder="N/A" style="font-size:11px" readonly><?= $apt_diag?></textarea>  
                             </div>
                        <div class="form-group">
                            <label>Medication/s: </label>
                            <textarea class="form-control" id ="setaptmed" rows="2" placeholder="N/A" style="font-size:11px"  readonly> <?= $apt_med?></textarea>  
                             </div>
                      <div class="form-group">
                            <label>Vaccination: </label>
                            <textarea class="form-control" id ="setaptvac" rows="2" placeholder="N/A" style="font-size:11px" readonly> <?= $apt_vac?> </textarea>  
                             </div>
                      <div class="form-group">
                            <label>Other information: </label>
                            <textarea class="form-control" id ="setaptinfo" rows="3" placeholder="N/A" style="font-size:11px"  readonly> <?= $apt_info?></textarea>  
                             </div>
                                  </div>
                            </div>
                    <div class="card card-primary scroller" style="margin-left:30px; width: 530px; font-size:14px" >   
                <div class="card-body">	
                    <h5 class="text-left">Disease and Symptom of <?php echo $name ?></h5>   
                    <div>
                    <table class="table">
                        <tbody>
                            <?php foreach ($diagValues as $diagValue): ?>
                                <tr>
                                    <td><?php echo $diagValue; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                    </div>

                    </div>
                </div>
                    
                </div>