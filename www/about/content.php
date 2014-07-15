<?php
	/**
	 *  @File			content.php
	 * 	@Authors		Jose Flores
	 * 					jose.flores.152@gmail.com
	 * 	
	 * 	@Description	This file holds the about page
	 * 
	 * 	@changelog		
	 *	2/25/14			added iframe
	 */
	 
	//	Define guard prevents acces unless from the index.php file at 
	//	this level
	if ( !defined( 'CONTENT_GUARD' ) ) 
		header( 'Location: ./' ) ;
		
	// Content begin
	echo '<div class="article">
	<h2>Mission</h2>
	<p>
		The CSR Project is a computer science research project being conducted  by students and faculty at the University of Massachussets Lowell. 
		The research centers on data-intensive analytics to be used in healthcare monitoring, ideal for patients with chronic diseases and the elderly.  The CSR Project has been made possible due to the accessibility and range of portable smart devices, equipped with unobstructive sensors which allow for the collection of medical data from patients living outside of medical facilities. 
	</p>
	<p>
		This project allows for the unprecedented opportunity to discover early predictors and biomarkers,  support clinical decision-making with physiological  data, and reduce patient and provider time and costs. 
	</p>
	<p>
		The long-term objective of this research ptoject is to investigate, develop, and validate new data-intensive analytics models and algorithms, with current efforts narrowed to data analytics for three types of physiological data: 
			<ul>
			<li>Time series data from body sensors and smartphones; </li>
			<li>Human motion data from Microsoft Kinect; and </li>
			<li>Electroencephalography (EEG) data from EPOC neuroheadset consumer brain-computer interfaces (BCI), with immediate applications on assisted living environment for aging population and in-home monitoring/rehabilitation for patients with chronic diseases. </li>
			</ul>
	</p>
	
	<h2> Faculty </h2>
	<table>
		<tr><td>Dr. Yu Cao</td></tr>
	</table>
	
	<h2> Students </h2>
	<table>
		<tr><td>Jose Flores </td> 	<td> Cloud Computing</td>			<td>SP14 - Current</td></tr>
		<tr><td>Peng Hou</td>		<td> Android Developement</td>		<td>SP14 - Current</td></tr>
		<tr><td>Brian Mandel</td>	<td> Peripheral Developement</td>	<td>SP14 - Current</td></tr>
		<tr><td>Sudhir Vaidya</td>	<td> Cloud Computing</td>			<td>SU14 - Current</td></tr>
		<tr><td>Veena Vignale</td>	<td> Data Processing</td>			<td>SU14 - Current</td></tr>
		<tr><td>Johnny Zheng</td>	<td> Data Processing</td> 			<td>SU14 - Current</td></tr>
	</table>
	
	<h2> Collaborators </h2>
	<p>
	Real-world validation of our proposed approach is being conducted with our clinic collaborators, Drs. F. Fesmire and G. Heath at the University of Tennessee: College of Medicine Chattanooga.
	</p>
	
	<h2> Publications </h2>
	<p>
Our research results have been published in top journals and conferences.
	<ul>
	<li>IEEE Transactions on Biomedical Engineering (TBME)</li>
	<li>Journal of Neural Computing & Applications (NCA) by Springer</li>
	<li>Journal of Cognitive Neurodynamics by Springer</li>
	<li>ACM Multimedia</li>
	<li>ACM/IEEE BodyNets</li>
	<li>IEEE EMBS</li>
	<li>etc ... </li>
	</ul>
	</p>
	</div>' ;
?>
